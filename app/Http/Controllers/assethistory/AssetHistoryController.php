<?php

namespace App\Http\Controllers\assethistory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\AssetHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Testing\Assert;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

class AssetHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assetshistory()
    {
        $title = "Assets History";
        $fuelhistory = DB::table('assets_history')
            ->where('type_asset', '=', 'BBM')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        return view('assethistory/assets-history', compact(
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
        $title = "Create";
        $model = new AssetHistory;
        //get tanggal bulan hari
        $now = Carbon::now('Asia/Makassar');
        $thnbulan = $now->year . $now->month . $now->day;
        $tanggalskrg = Date('Y-m-d');

        $cek2 = AssetHistory::count();
        if ($cek2 === 0) {
            $urut2 = 1000001;
            $nomorstok = 'BS' . $thnbulan . $urut2;
        } else {
            $ambildata2 = AssetHistory::all()->last();
            $urut2 = (int)substr($ambildata2->id_stock, -8) + 1;
            $nomorstok = 'BS' . $thnbulan . $urut2;
        }

        $cek = AssetHistory::count();
        if ($cek === 0) {
            $urut = 1000001;
            $nomor = 'TR' . $thnbulan . $urut;
        } else {
            $ambildata = AssetHistory::all()->last();
            $urut = (int)substr($ambildata->id_transaction, -8) + 1;
            $nomor = 'TR' . $thnbulan . $urut;
        }

        return view('asset/create', compact(
            'model',
            'title',
            'nomor',
            'nomorstok',
            'tanggalskrg'
        ));
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

        return redirect('/');
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
        $title = "Edit";
        $model = AssetHistory::find($id);
        $tanggalskrg = Date('Y-m-d');

        return view('assethistory/edit', compact(
            'model',
            'title'
        ));
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
        $model = AssetHistory::find($id);
        $model->id_stock = $request->id_stock;
        $model->id_transaction = $request->id_transaction;
        $model->date = $request->date;
        $model->material = $request->material;
        $model->qty = $request->qty;
        $model->unit = $request->unit;
        $model->price = $request->price;
        $model->total_price = $request->total_price;
        $model->users = "$request->users";
        $model->in_out = $request->in_out;
        $model->desc = $request->desc;
        $model->type_asset = $request->type_asset;
        $model->supplier = $request->supplier;
        $model->save();

        $model = Asset::find($id);
        $model->date = $request->date;
        $model->material = $request->material;
        $model->qty = $request->qty;
        $model->unit = $request->unit;
        $model->type_asset = $request->type_asset;
        $model->save();

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
