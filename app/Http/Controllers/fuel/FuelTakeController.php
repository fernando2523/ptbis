<?php

namespace App\Http\Controllers\fuel;

use App\Http\Controllers\Controller;
use App\Models\Fuel;
use App\Models\Fueltake_stocker;
use App\Models\Fueltake_sender;
use App\Models\Fueltake_receiver;
use App\Models\AssetHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class FuelTakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fueldelivery()
    {
        $title = "Fuel Delivery";

        $jerigen = DB::table('assets')
            ->where('type_asset', '=', 'JERIGEN')
            ->select('material', 'isi_jerigen')
            ->get();

        $vehicle = DB::table('vehicle')
            ->where('type_vehicle', 'like', "%" . 'LV-' . "%")
            ->select('type_vehicle')
            ->get();

        $datafuel = Fuel::all();

        $now = Carbon::now('Asia/Bangkok');
        $thnbulan = $now->year . $now->month . $now->day;
        $tanggalskrg = Date('Y-m-d');
        $time = $now->format('H:i:s');

        $cek = Fueltake_stocker::count();
        if ($cek === 0) {
            $urut = 1000001;
            $idact = 'TR' . $thnbulan . $urut;
        } else {
            $ambildata = Fueltake_stocker::all()->last();
            $urut = (int)substr($ambildata->id_activity, -7) + 1;
            $idact = 'TR' . $thnbulan . $urut;
        }

        return view('fueldelivery.fuel-delivery', compact(
            'title',
            'idact',
            'tanggalskrg',
            'datafuel',
            'jerigen',
            'time',
            'vehicle'
        ));
    }

    public function datatablefuel_stocker(Request $request)
    {
        if ($request->ajax()) {
            $data = Fueltake_stocker::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('qrcodes', function () {
                })
                ->addColumn('action', function () {
                })
                ->rawColumns(['qrcodes', 'action'])
                ->make(true);
        }
    }

    // public function datatablefuel_sender(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Fueltake_sender::latest()->get();
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             // ->addColumn('action', function () {
    //             // })
    //             // ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    // public function datatablefuel_receiver(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Fueltake_receiver::latest()->get();
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             // ->addColumn('action', function () {
    //             // })
    //             // ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }
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
        $now = Carbon::now('Asia/Bangkok');
        $thnbulan = $now->year . $now->month . $now->day;

        $cek = AssetHistory::count();
        if ($cek === 0) {
            $urut = 1000001;
            $nomor = 'TR' . $thnbulan . $urut;
        } else {
            $ambildata = AssetHistory::all()->last();
            $urut = (int)substr($ambildata->id_transaction, -7) + 1;
            $nomor = 'TR' . $thnbulan . $urut;
        }

        $model3 = DB::table('fuel_stock')
            ->where('id_stock', '=', $request->id_stock)
            ->pluck('material');
        $model4 = $model3->toArray();
        $model5 = implode(" ", $model4);
        // didie

        $getqtyinput = $request->qty;
        $getunit = $request->unit;

        if ($getunit === "LITER") {
            $model2 = new Fueltake_stocker();
            $model2->id_activity = $request->id_activity;
            $model2->id_stock = $request->id_stock;
            $model2->material = $model5;
            $model2->stocker = $request->stocker;
            $model2->date = $request->date;
            $model2->qty = $request->qty;
            $model2->unit = $request->unit;
            $model2->device_stocker = $request->device_stocker;
            $model2->hour_stocker = $request->hour_stocker;
            $model2->server_stocker = $request->server_stocker;
            $model2->pic = $request->pic;
            $model2->vehicle = $request->vehicle;
            $model2->retur = "0";
            $model2->save();

            $model = new AssetHistory;
            $model->id_stock = $request->id_stock;
            $model->id_transaction = $nomor;
            $model->date = $request->date;
            $model->material = $model5;
            $model->ket = $getqtyinput . " LITER";
            $model->qty = $request->qty;
            $model->unit = "LITER";
            $model->price = "0";
            $model->total_price = "0";
            $model->users = $request->stocker;
            $model->in_out = "FUEL DELIVERY";
            $model->desc = null;
            $model->type_asset = "BBM";
            $model->supplier = "-";
            $model->save();

            $model6 = DB::table('fuel_stock')
                ->where('id_stock', '=', $request->id_stock)
                ->pluck('qty');
            $model7 = $model6->toArray();
            $model8 = implode(" ", $model7);

            fuel::where('id_stock', $request->id_stock)
                ->update([
                    'qty' => $model8 - $request->qty
                ]);
        } else {
            // Jumlah Jerigen
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
            // End Jumlah Jerigen

            $model2 = new Fueltake_stocker();
            $model2->id_activity = $request->id_activity;
            $model2->id_stock = $request->id_stock;
            $model2->material = $model5;
            $model2->stocker = $request->stocker;
            $model2->date = $request->date;
            $model2->qty = $request->qty;
            $model2->unit = $request->unit;
            $model2->device_stocker = $request->device_stocker;
            $model2->hour_stocker = $request->hour_stocker;
            $model2->server_stocker = $request->server_stocker;
            $model2->pic = $request->pic;
            $model2->vehicle = $request->vehicle;
            $model2->retur = "0";
            $model2->save();

            $model = new AssetHistory;
            $model->id_stock = $request->id_stock;
            $model->id_transaction = $nomor;
            $model->date = $request->date;
            $model->material = $model5;
            $model->ket = $getqtyinput . " : " . $getnamejerigen3;
            $model->qty = $hasiljerigen;
            $model->unit = "LITER";
            $model->price = "0";
            $model->total_price = "0";
            $model->users = $request->stocker;
            $model->in_out = "FUEL DELIVERY";
            $model->desc = $getnamejerigen3 . " - ";
            $model->type_asset = "BBM";
            $model->supplier = "-";
            $model->save();

            $model6 = DB::table('fuel_stock')
                ->where('id_stock', '=', $request->id_stock)
                ->pluck('qty');
            $model7 = $model6->toArray();
            $model8 = implode(" ", $model7);

            fuel::where('id_stock', $request->id_stock)
                ->update([
                    'qty' => $model8 - $hasiljerigen
                ]);
        }

        return redirect('/fuel-delivery');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuelTake  $fuelTake
     * @return \Illuminate\Http\Response
     */
    public function show(FuelTake $fuelTake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FuelTake  $fuelTake
     * @return \Illuminate\Http\Response
     */
    public function edit(FuelTake $fuelTake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FuelTake  $fuelTake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FuelTake $fuelTake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuelTake  $fuelTake
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Fueltake_stocker::destroy($id);

        return redirect('/fuel-delivery');
    }

    public function load_barcode(Request $request)
    {
        $id = $request->qr_code;

        return view('/load/barcode', compact('id'));
    }
}
