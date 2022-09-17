<?php

namespace App\Http\Controllers\asset;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;
use App\Models\AssetHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Testing\Assert;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assets()
    {
        $title = "Assets";
        // $datas = Asset::all();
        $datas = DB::table('assets')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();



        $history = DB::table('assets_history')
            ->where('type_asset', '!=', 'BBM')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $totalstock = DB::table('assets')
            ->where('type_asset', '!=', 'BBM')
            ->where('type_asset', '!=', 'JERIGEN')
            ->sum('qty');

        $totalasset = DB::table('assets')
            ->where('type_asset', '=', 'ASET TETAP')
            ->sum('qty');

        $totalbahanbaku = DB::table('assets')
            // ->where('in_out', '=', 'EDITED')
            ->where('type_asset', '=', 'BAHAN BAKU')
            ->sum('qty');

        $purchased = DB::table('assets_history')
            ->where('in_out', '=', 'IN')
            ->where('type_asset', '!=', 'BBM')
            ->sum('total_price');

        // $cariprice = DB::table('assets_history')
        //     ->where('type_asset', '!=', 'BBM')
        //     ->where('in_out', '=', 'IN')
        //     ->average('total_price');
        // $cariprice2 = intval($cariprice);

        // $cariprice = DB::table('assets')
        // $cariqty = Asset::find($id);
        // $cariqty2 = $cariqty->qty;

        // $hasilavg = $cariprice2 * $cariqty2;
        // dd($cariprice2);

        //get tanggal bulan hari
        $now = Carbon::now('Asia/Bangkok');
        $thnbulan = $now->year . $now->month . $now->day;
        $tanggalskrg = Date('Y-m-d');

        $cek2 = Asset::count();
        if ($cek2 === 0) {
            $urut2 = 1000001;
            $nomorstok = 'BS' . $thnbulan . $urut2;
        } else {
            $ambildata2 = Asset::all()->last();
            $urut2 = (int)substr($ambildata2->id_stock, -7) + 1;
            $nomorstok = 'BS' . $thnbulan . $urut2;
        }

        $cek = AssetHistory::count();
        if ($cek === 0) {
            $urut = 1000001;
            $nomor = 'TR' . $thnbulan . $urut;
        } else {
            $ambildata = AssetHistory::all()->last();
            $urut = (int)substr($ambildata->id_transaction, -7) + 1;
            $nomor = 'TR' . $thnbulan . $urut;
        }

        return view('asset/assets', compact(
            'datas',
            'title',
            'totalstock',
            'totalasset',
            'totalbahanbaku',
            'purchased',
            'history',
            'nomor',
            'nomorstok',
            'tanggalskrg'
        ));
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Asset::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('restock', function () {
                    $restockBtn = '
                    <span>
                    <a class="theme-success" style="cursor: pointer;" id="restock_btn" ><i class="fas fa-xl fa-retweet"></i></a>
                    </span>
                    ';
                    return $restockBtn;
                })
                ->addColumn('outstock', function () {
                    $outstockBtn = '
                    <span>
                    <a class="text-danger" style="cursor: pointer;" id="outstock_btn"><i class="far fa-xl fa-share-square"></i></a>
                    </span>
                    ';
                    return $outstockBtn;
                })
                ->addColumn('action', function () {
                    $actionBtn = '
                    <span>
                    <a class="text-primary" style="cursor: pointer;" id="edit_btn"><i class="fas fa-xl fa-edit">  </i></a>
                    </span>
                    <span><a class="text-default" style="font-weight: bold;">|</a></span>
                    <span>
                    <a class="text-danger" style="cursor: pointer;" id="delete_btn"><i class="fas fa-xl fa-times-circle"></i></a>
                    </span>
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['restock', 'outstock', 'action'])
                ->make(true);
        }
    }

    public function datatablehistory(Request $request)
    {
        if ($request->ajax()) {
            $data = AssetHistory::latest()->where('type_asset', '!=', 'BBM')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function historyasset()
    {
        $title = "Asset History";
        $assetshistory = DB::table('assets_history')
            ->where('type_asset', '!=', 'BBM')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('asset/history', compact(
            'title',
            'assetshistory'
        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Asset;
        $model->id_stock = $request->id_stock;
        $model->date = $request->date;
        $model->material = $request->material;
        $model->qty = $request->qty;
        $model->unit = $request->unit;
        $model->type_asset = $request->type_asset;
        $model->isi_jerigen = $request->isi_jerigen;
        $model->save();

        $model = new AssetHistory;
        $model->id_stock = $request->id_stock;
        $model->id_transaction = $request->id_transaction;
        $model->date = $request->date;
        $model->material = $request->material;
        $model->qty = $request->qty;
        $model->unit = $request->unit;
        $model->price = $request->price;
        $model->total_price = $request->total_price;
        $model->users = $request->users;
        $model->in_out = "IN";
        $model->desc = $request->desc;
        $model->type_asset = $request->type_asset;
        $model->supplier = $request->supplier;
        $model->save();

        return redirect('/asset');
    }


    public function editact(Request $request, $id)
    {
        $model = Asset::find($id);
        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');

        AssetHistory::insert([
            'id_stock' => $model->id_stock,
            'id_transaction' => $request->e_id_transaction,
            'date' => $tanggalskrg,
            'material' => $request->e_material,
            'qty' => $model->qty,
            'unit' => $model->unit,
            'price' => "",
            'total_price' => "",
            'users' => auth::user()->name,
            'in_out' => "EDITED",
            'desc' => "",
            'type_asset' => $model->type_asset,
            'supplier' => "-",
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $edit2 = Asset::find($id);
        $edit2->material = $request->e_material;
        $edit2->unit = $request->e_unit;
        $edit2->type_asset = $request->e_type_asset;

        $edit2->update();

        return redirect('/asset');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = new AssetHistory;
        $model->id_stock = $request->r_id_stock;
        $model->id_transaction = $request->r_id_transaction;
        $model->date = $request->r_date;
        $model->material = $request->r_material;
        $model->qty = $request->r_qty;
        $model->unit = $request->r_unit;
        $model->price = $request->r_price;
        $model->total_price = $request->r_total_price;
        $model->users = $request->r_users;
        $model->in_out = "IN";
        $model->desc = $request->r_desc;
        $model->type_asset = $request->r_type_asset;
        $model->supplier = $request->r_supplier;
        $model->save();

        $model2 = Asset::find($id);
        $model2->qty = $request->r_qty + $model2->qty;
        $model2->update();

        return redirect('/asset');
    }

    public function outstockact(Request $request, $id)
    {
        $model = new AssetHistory;
        $model->id_stock = $request->o_id_stock;
        $model->id_transaction = $request->o_id_transaction;
        $model->date = $request->o_date;
        $model->material = $request->o_material;
        $model->qty = $request->o_qty;
        $model->unit = $request->o_unit;
        $model->price = "";
        $model->total_price = "";
        $model->users = $request->o_users;
        $model->in_out = "OUT";
        $model->desc = $request->o_desc;
        $model->type_asset = $request->o_type_asset;
        $model->supplier = "-";
        $model->save();

        $model2 = Asset::find($id);
        $model2->qty = $model2->qty - $request->o_qty;
        $model2->update();

        return redirect('/asset');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = Asset::find($id);
        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');

        AssetHistory::insert([
            'id_stock' => $model->id_stock,
            'id_transaction' => $request->del_id_transaction,
            'date' => $tanggalskrg,
            'material' => $model->material,
            'qty' => $model->qty,
            'unit' => $model->unit,
            'price' => "",
            'total_price' => "",
            'users' => auth::user()->name,
            'in_out' => "DELETED",
            'desc' => "",
            'type_asset' => $model->type_asset,
            'supplier' => "-",
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Asset::destroy($id);

        return redirect('/asset');
    }

    public function destroyhistory(Request $request, $id)
    {
        $getstatus = $request->del_in_out;
        $getidstock = $request->del_id_stock;
        $getqtybaru = $request->del_qty;

        $qtyawal = DB::table('assets')
            ->where('id_stock', '=', $getidstock)
            ->pluck('qty');
        $qtyawal2 = $qtyawal->toArray();
        $qtyawal3 = implode(" ", $qtyawal2);

        if ($getstatus === "IN") {
            Asset::where('id_stock', $getidstock)
                ->update([
                    'qty' => $qtyawal3 - $getqtybaru,
                ]);
        } else if ($getstatus === "OUT") {
            Asset::where('id_stock', $getidstock)
                ->update([
                    'qty' => $qtyawal3 + $getqtybaru,
                ]);
        }

        AssetHistory::destroy($id);

        return redirect('/asset/history');
    }
}
