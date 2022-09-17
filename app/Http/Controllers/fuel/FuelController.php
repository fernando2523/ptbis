<?php

namespace App\Http\Controllers\fuel;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetHistory;
use App\Models\Fuel;
use App\Models\FuelTake;
use App\Models\FuelRefill;
use App\Models\Fueltake_stocker;
use Carbon\Carbon;
use FuelStock;
use Illuminate\Support\Facades\Date;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fuel()
    {
        $title = "Fuel";
        // $datas = Asset::all();
        $buying = DB::table('assets_history')
            ->where('in_out', '=', 'IN')
            ->where('type_asset', '=', 'BBM')
            ->sum('qty');

        $used = DB::table('assets_history')
            ->where('in_out', '=', 'OUT')
            ->where('type_asset', '=', 'BBM')
            ->sum('qty');

        $purchased = DB::table('assets_history')
            ->where('in_out', '=', 'IN')
            ->where('type_asset', '=', 'BBM')
            ->sum('total_price');

        $fuel_stock = DB::table('fuel_stock')
            ->where('type_asset', '=', 'BBM')
            ->sum('qty');

        $fuel_stoker = DB::table('fueltake_stockers')
            ->get();

        $fuel_refill = DB::table('fuel_refill')
            ->sum('qty');

        $jerigen = DB::table('assets')
            ->where('type_asset', '=', 'JERIGEN')
            ->select('material', 'isi_jerigen')
            ->get();

        $act = DB::table('fueltake_stockers')
            ->select('id_activity', 'date', 'qty', 'unit', 'vehicle', 'pic')
            ->orderBy('date', 'desc')
            ->limit('15')
            ->get();

        $datas = DB::table('fuel_stock')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        $history = DB::table('assets_history')
            ->where('type_asset', '=', 'BBM')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $delivery = DB::table('fueltake_stockers')
            ->orderBy('date', 'desc')
            ->limit(10)
            ->get();

        $delivery2 = DB::table('fueltake_senders')
            ->orderBy('id_activity', 'desc')
            ->limit(10)
            ->get();

        $delivery3 = DB::table('fueltake_receivers')
            ->orderBy('id_activity', 'desc')
            ->limit(10)
            ->get();

        $refill = DB::table('fuel_refill')
            ->orderBy('id_activity', 'desc')
            ->limit(10)
            ->get();

        $datavehicle = DB::table('vehicle')
            ->orderBy('id', 'desc')
            ->get();

        $datareceiver = DB::table('fuel_stock')
            ->get();

        $now = Carbon::now('Asia/Bangkok');
        $thnbulan = $now->year . $now->month . $now->day;
        $tanggalskrg = Date('Y-m-d');
        $time = $now->format('H:i:s');

        $cek2 = Fuel::count();
        if ($cek2 === 0) {
            $urut2 = 1001;
            $nomorstok = 'FL' . $thnbulan . $urut2;
        } else {
            $ambildata2 = Fuel::all()->last();
            $urut2 = (int)substr($ambildata2->id_stock, -4) + 1;
            $nomorstok = 'FL' . $thnbulan . $urut2;
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

        $ceks = FuelRefill::count();
        if ($ceks === 0) {
            $uruts = 1000001;
            $idact = 'ACT' . $thnbulan . $uruts;
        } else {
            $ambildatas = FuelRefill::all()->last();
            $uruts = (int)substr($ambildatas->id_activity, -7) + 1;
            $idact = 'ACT' . $thnbulan . $uruts;
        }

        return view('fuel.fuel', compact(
            'datas',
            'title',
            'buying',
            'used',
            'purchased',
            'fuel_stock',
            'history',
            'nomor',
            'nomorstok',
            'tanggalskrg',
            'delivery',
            'delivery2',
            'delivery3',
            'refill',
            'fuel_stoker',
            'fuel_refill',
            'jerigen',
            'datavehicle',
            'time',
            'idact',
            'datareceiver',
            'act'
        ));
    }

    public function datatablefuel(Request $request)
    {
        if ($request->ajax()) {
            $data = Fuel::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('restock', function () {
                })
                ->addColumn('retur', function () {
                })
                ->addColumn('action', function () {
                })
                ->rawColumns(['restock', 'retur', 'action'])
                ->make(true);
        }
    }

    public function datatablefuelhistory(Request $request)
    {
        if ($request->ajax()) {
            $data = AssetHistory::latest()->where('type_asset', '=', 'BBM')->get();
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
        $title = "Fuel History";
        $fuelhistory = DB::table('assets_history')
            ->where('type_asset', '=', 'BBM')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('fuel/history', compact(
            'title',
            'fuelhistory'
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
        $getqtyinput = $request->qty;
        $getunit = $request->unit;

        $getvalue = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('isi_jerigen');
        $getvalue2 = $getvalue->toArray();
        $getvalue3 = implode(" ", $getvalue2);

        $getnamejerigen = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('material');
        $getnamejerigen2 = $getnamejerigen->toArray();
        $getnamejerigen3 = implode(" ", $getnamejerigen2);

        $hasiljerigen = floatval($getqtyinput) * floatval($getvalue3);

        if ($getunit === "LITER") {
            $model = new AssetHistory;
            $model->id_stock = $request->id_stock;
            $model->id_transaction = $request->id_transaction;
            $model->date = $request->date;
            $model->material = $request->material;
            $model->ket = $getqtyinput . " LITER";
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

            $model = new Fuel;
            $model->id_stock = $request->id_stock;
            $model->date = $request->date;
            $model->material = $request->material;
            $model->qty = $request->qty;
            $model->unit = $request->unit;
            $model->type_asset = $request->type_asset;
            $model->save();
        } else {
            $model = new AssetHistory;
            $model->id_stock = $request->id_stock;
            $model->id_transaction = $request->id_transaction;
            $model->date = $request->date;
            $model->material = $request->material;
            $model->ket = $getqtyinput . " : " . $getnamejerigen3;
            $model->qty = $hasiljerigen;
            $model->unit = "LITER";
            $model->price = $request->price;
            $model->total_price = $request->total_price;
            $model->users = $request->users;
            $model->in_out = "IN";
            $model->desc = $getnamejerigen3 . ' - ' . $request->desc;
            $model->type_asset = $request->type_asset;
            $model->supplier = $request->supplier;
            $model->save();

            $model = new Fuel;
            $model->id_stock = $request->id_stock;
            $model->date = $request->date;
            $model->material = $request->material;
            $model->qty = $hasiljerigen;
            $model->unit = "LITER";
            $model->type_asset = $request->type_asset;
            $model->save();
        }

        return redirect('/fuel');
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

    public function editact(Request $request, $id)
    {
        $model = Fuel::find($id);
        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');

        AssetHistory::insert([
            'id_stock' => $model->id_stock,
            'id_transaction' => $request->e_id_transaction,
            'date' => $tanggalskrg,
            'material' => $request->e_material,
            'ket' =>  "-",
            'qty' => $model->qty,
            'unit' => $model->unit,
            'price' => "",
            'total_price' => "",
            'users' => auth::user()->name,
            'in_out' => "EDITED",
            'desc' => null,
            'type_asset' => $model->type_asset,
            'supplier' => "-",
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $edit2 = Fuel::find($id);
        $edit2->material = $request->e_material;
        $edit2->unit = $request->e_unit;
        $edit2->update();

        return redirect('/fuel');
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
        $getqtyinput = $request->r_qty;
        $getunit = $request->r_unit;

        $getvalue = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('isi_jerigen');
        $getvalue2 = $getvalue->toArray();
        $getvalue3 = implode(" ", $getvalue2);

        $getnamejerigen = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('material');
        $getnamejerigen2 = $getnamejerigen->toArray();
        $getnamejerigen3 = implode(" ", $getnamejerigen2);

        $hasiljerigen = floatval($getqtyinput) * floatval($getvalue3);

        if ($getunit === "LITER") {
            $model = new AssetHistory;
            $model->id_stock = $request->r_id_stock;
            $model->id_transaction = $request->r_id_transaction;
            $model->date = $request->r_date;
            $model->material = $request->r_material;
            $model->ket = $getqtyinput . " LITER";
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

            $model2 = Fuel::find($id);
            $model2->qty = $request->r_qty + $model2->qty;
            $model2->update();
        } else {
            $model = new AssetHistory;
            $model->id_stock = $request->r_id_stock;
            $model->id_transaction = $request->r_id_transaction;
            $model->date = $request->r_date;
            $model->material = $request->r_material;
            $model->ket = $getqtyinput . " : " . $getnamejerigen3;
            $model->qty = $hasiljerigen;
            $model->unit = "LITER";
            $model->price = $request->r_price;
            $model->total_price = $request->r_total_price;
            $model->users = $request->r_users;
            $model->in_out = "IN";
            $model->desc = $getnamejerigen3 . ' - ' . $request->r_desc;
            $model->type_asset = $request->r_type_asset;
            $model->supplier = $request->r_supplier;
            $model->save();

            $model2 = Fuel::find($id);
            $model2->qty = $hasiljerigen + $model2->qty;
            $model2->update();
        }

        return redirect('/fuel');
    }

    public function retur(Request $request, $id)
    {
        $getqtyinput = $request->rt_qty_new;
        $getact = $request->rt_act;

        $ambilunit = DB::table('fueltake_stockers')
            ->where('id_activity', '=', $getact)
            ->pluck('unit');
        $ambilunit2 = $ambilunit->toArray();
        $ambilunit3 = implode(" ", $ambilunit2);

        $getunit = $ambilunit3;

        $getvalue = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('isi_jerigen');
        $getvalue2 = $getvalue->toArray();
        $getvalue3 = implode(" ", $getvalue2);

        $getnamejerigen = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('material');
        $getnamejerigen2 = $getnamejerigen->toArray();
        $getnamejerigen3 = implode(" ", $getnamejerigen2);

        $hasiljerigen = floatval($getqtyinput) * floatval($getvalue3);

        if ($getunit === "LITER") {
            $model = new AssetHistory;
            $model->id_stock = $request->rt_id_stock;
            $model->id_transaction = $request->rt_id_transaction;
            $model->date = $request->rt_date;
            $model->material = $request->rt_material;
            $model->ket = $getqtyinput . " LITER";
            $model->qty = $request->rt_qty_new;
            $model->unit = $getunit;
            $model->price = "0";
            $model->total_price = "0";
            $model->users = $request->rt_users;
            $model->in_out = "RETUR";
            $model->desc = $request->rt_desc;
            $model->type_asset = $request->rt_type_asset;
            $model->supplier = "-";
            $model->save();

            $model2 = Fuel::find($id);
            $model2->qty = $request->rt_qty_new + $model2->qty;
            $model2->update();

            Fueltake_stocker::where('id_activity', $getact)
                ->update([
                    'retur' => $getqtyinput
                ]);
        } else {
            $model = new AssetHistory;
            $model->id_stock = $request->rt_id_stock;
            $model->id_transaction = $request->rt_id_transaction;
            $model->date = $request->rt_date;
            $model->material = $request->rt_material;
            $model->ket = $getqtyinput . " : " . $getnamejerigen3;
            $model->qty = $hasiljerigen;
            $model->unit = "LITER";
            $model->price = "0";
            $model->total_price = "0";
            $model->users = $request->rt_users;
            $model->in_out = "RETUR";
            $model->desc = $getnamejerigen3 . ' - ' . $request->rt_desc;
            $model->type_asset = $request->rt_type_asset;
            $model->supplier = "-";
            $model->save();

            $model2 = Fuel::find($id);
            $model2->qty = $hasiljerigen + $model2->qty;
            $model2->update();

            Fueltake_stocker::where('id_activity', $getact)
                ->update([
                    'retur' => $getqtyinput
                ]);
        }

        return redirect('/fuel');
    }

    public function outstockact(Request $request)
    {
        $getqtyinput = $request->o_qty;
        $getunit = $request->o_unit;

        $getmaterial2 = DB::table('fuel_stock')
            ->where('id_stock', '=', $request->o_id_stock)
            ->pluck('material');
        $getmaterial3 = $getmaterial2->toArray();
        $getmaterial4 = implode(" ", $getmaterial3);
        // cari vehicle
        $carivehiclel5 = DB::table('vehicle')
            ->where('vehicle_id', '=', $request->o_vehicle_id)
            ->pluck('vehicle_unit');
        $carivehiclel6 = $carivehiclel5->toArray();
        $carivehiclel7 = implode(" ", $carivehiclel6);

        $getvalue = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('isi_jerigen');
        $getvalue2 = $getvalue->toArray();
        $getvalue3 = implode(" ", $getvalue2);

        $getnamejerigen = DB::table('assets')
            ->where('material', '=', $getunit)
            ->pluck('material');
        $getnamejerigen2 = $getnamejerigen->toArray();
        $getnamejerigen3 = implode(" ", $getnamejerigen2);

        $hasiljerigen = floatval($getqtyinput) * floatval($getvalue3);

        if ($getunit === "LITER") {
            $model = new AssetHistory;
            $model->id_stock = $request->o_id_stock;
            $model->id_transaction = $request->o_id_transaction;
            $model->date = $request->o_date;
            $model->material = $getmaterial4;
            $model->ket = $getqtyinput . " LITER";
            $model->qty = $getqtyinput;
            $model->unit = $getunit;
            $model->price = "0";
            $model->total_price = "0";
            $model->users = $request->o_users;
            $model->in_out = "REFILL IN OFFICE";
            $model->desc = $request->o_desc;
            $model->type_asset = $request->o_type_asset;
            $model->supplier = "-";
            $model->save();

            $modelinput2 = new FuelRefill();
            $modelinput2->id_stock = $request->o_id_stock;
            $modelinput2->id_activity = $request->o_id_activity;
            $modelinput2->date = $request->o_date;
            $modelinput2->hour = $request->o_hour;
            $modelinput2->material = $getmaterial4;
            $modelinput2->vehicle_id = $request->o_vehicle_id;
            $modelinput2->vehicle_unit = $carivehiclel7;
            $modelinput2->operator = $request->o_operator;
            $modelinput2->qty = $request->o_qty;
            $modelinput2->unit = $getunit;
            $modelinput2->location = $request->o_location;
            $modelinput2->pic = $request->o_pic;
            $modelinput2->users = $request->o_users;
            $modelinput2->device = $request->o_device;
            $modelinput2->server = $request->o_server;
            $modelinput2->stock_from = $request->o_stock_from;
            $modelinput2->save();

            $cariqty = DB::table('fuel_stock')
                ->where('id_stock', '=', $request->o_id_stock)
                ->pluck('qty');
            $cariqty2 = $cariqty->toArray();
            $cariqty3 = implode(" ", $cariqty2);

            Fuel::where('id_stock', $request->o_id_stock)
                ->update([
                    'qty' => $cariqty3 - $getqtyinput
                ]);
        } else {
            $model = new AssetHistory;
            $model->id_stock = $request->o_id_stock;
            $model->id_transaction = $request->o_id_transaction;
            $model->date = $request->o_date;
            $model->material = $getmaterial4;
            $model->ket = $getqtyinput . " : " . $getnamejerigen3;
            $model->qty = $hasiljerigen;
            $model->unit = "LITER";
            $model->price = "0";
            $model->total_price = "0";
            $model->users = $request->o_users;
            $model->in_out = "REFILL IN OFFICE";
            $model->desc = $getnamejerigen3 . ' - ' . $request->o_desc;
            $model->type_asset = $request->o_type_asset;
            $model->supplier = "-";
            $model->save();

            $modelinput2 = new FuelRefill();
            $modelinput2->id_stock = $request->o_id_stock;
            $modelinput2->id_activity = $request->o_id_activity;
            $modelinput2->date = $request->o_date;
            $modelinput2->hour = $request->o_hour;
            $modelinput2->material = $getmaterial4;
            $modelinput2->vehicle_id = $request->o_vehicle_id;
            $modelinput2->vehicle_unit = $carivehiclel7;
            $modelinput2->operator = $request->o_operator;
            $modelinput2->qty = $hasiljerigen;
            $modelinput2->unit = "LITER";
            $modelinput2->location = $request->o_location;
            $modelinput2->pic = $request->o_pic;
            $modelinput2->users = $request->o_users;
            $modelinput2->device = $request->o_device;
            $modelinput2->server = $request->o_server;
            $modelinput2->stock_from = $request->o_stock_from;
            $modelinput2->save();

            $cariqty = DB::table('fuel_stock')
                ->where('id_stock', '=', $request->o_id_stock)
                ->pluck('qty');
            $cariqty2 = $cariqty->toArray();
            $cariqty3 = implode(" ", $cariqty2);

            Fuel::where('id_stock', $request->o_id_stock)
                ->update([
                    'qty' => $cariqty3 - $hasiljerigen
                ]);
        }

        return redirect('/fuel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $model = Fuel::find($id);
        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');

        AssetHistory::insert([
            'id_stock' => $model->id_stock,
            'id_transaction' => $request->del_id_transaction,
            'date' => $tanggalskrg,
            'material' => $model->material,
            'ket' => "-",
            'qty' => $model->qty,
            'unit' => $model->unit,
            'price' => "",
            'total_price' => "",
            'users' => auth::user()->name,
            'in_out' => "DELETED",
            'desc' => null,
            'type_asset' => $model->type_asset,
            'supplier' => "-",
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        Fuel::destroy($id);

        return redirect('/fuel');
    }

    public function destroyhistory(Request $request, $id)
    {
        $getstatus = $request->del_in_out;
        $getidstock = $request->del_id_stock;
        $getqtybaru = $request->del_qty;

        $qtyawal = DB::table('fuel_stock')
            ->where('id_stock', '=', $getidstock)
            ->pluck('qty');
        $qtyawal2 = $qtyawal->toArray();
        $qtyawal3 = implode(" ", $qtyawal2);

        if ($getstatus === "IN") {
            Fuel::where('id_stock', $getidstock)
                ->update([
                    'qty' => $qtyawal3 - $getqtybaru,
                ]);
        } else if ($getstatus === "REFILL IN OFFICE") {
            Fuel::where('id_stock', $getidstock)
                ->update([
                    'qty' => $qtyawal3 + $getqtybaru,
                ]);
        } else if ($getstatus === "RETUR") {
            Fuel::where('id_stock', $getidstock)
                ->update([
                    'qty' => $qtyawal3 - $getqtybaru,
                ]);
        } else if ($getstatus === "FUEL DELIVERY") {
            Fuel::where('id_stock', $getidstock)
                ->update([
                    'qty' => $qtyawal3 + $getqtybaru,
                ]);
        }
        AssetHistory::destroy($id);

        return redirect('/fuel/history');
    }
}
