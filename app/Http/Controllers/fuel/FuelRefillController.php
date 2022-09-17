<?php

namespace App\Http\Controllers\fuel;

use App\Http\Controllers\Controller;
use App\Models\FuelRefill;
use App\Models\Fueltake_receiver;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class FuelRefillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fuelrefill()
    {
        $title = "Fuel Refill";
        $now = Carbon::now('Asia/Bangkok');
        $thnbulan = $now->year . $now->month . $now->day;
        $tanggalskrg = Date('Y-m-d');
        $time = $now->format('H:i:s');

        $datarefill = DB::table('fuel_refill')
            ->orderBy('id_activity', 'desc')
            ->limit(20)
            ->get();

        $datareceiver = DB::table('fueltake_receivers')
            ->where('date', '=', $tanggalskrg)
            ->get();

        $datavehicle = DB::table('vehicle')
            ->orderBy('id', 'desc')
            ->get();

        $dataloc = DB::table('locations')
            ->orderBy('id', 'asc')
            ->get();

        $ceks = FuelRefill::count();
        if ($ceks === 0) {
            $uruts = 1000001;
            $idact = 'ACT' . $thnbulan . $uruts;
        } else {
            $ambildata = FuelRefill::all()->last();
            $uruts = (int)substr($ambildata->id_activity, -7) + 1;
            $idact = 'ACT' . $thnbulan . $uruts;
        }

        return view('fuelrefill.fuel-refill', compact(
            'datarefill',
            'title',
            'idact',
            'tanggalskrg',
            'time',
            'datareceiver',
            'datavehicle',
            'dataloc'
        ));
    }

    public function datatablefuel_refill(Request $request)
    {
        if ($request->ajax()) {
            $data = FuelRefill::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // cari material
        $model2 = DB::table('fueltake_receivers')
            ->where('id_stock', '=', $request->id_stock)
            ->pluck('material');
        $model3 = $model2->toArray();
        $model4 = implode(" ", $model3);

        // cari vehicle
        $model5 = DB::table('vehicle')
            ->where('vehicle_id', '=', $request->vehicle_id)
            ->pluck('vehicle_unit');
        $model6 = $model5->toArray();
        $model7 = implode(" ", $model6);

        $modelinput2 = new FuelRefill();
        $modelinput2->id_stock = $request->input('id_stock');
        $modelinput2->id_activity = $request->input('id_activity');
        $modelinput2->date = $request->input('date');
        $modelinput2->hour = $request->input('hour');
        $modelinput2->material = $model4;
        $modelinput2->vehicle_id = $request->input('vehicle_id');
        $modelinput2->vehicle_unit = $model7;
        $modelinput2->operator = $request->input('operator');
        $modelinput2->qty = $request->input('qty');
        $modelinput2->unit = $request->input('unit');
        $modelinput2->location = $request->input('location');
        $modelinput2->pic = $request->input('pic');
        $modelinput2->users = $request->input('users');
        $modelinput2->device = $request->input('device');
        $modelinput2->server = $request->input('server');
        $modelinput2->save();

        $cariqty = DB::table('fueltake_receivers')
            ->where('id_stock', '=', $request->id_stock)
            ->where('date', '=', $request->date)
            ->pluck('qty');
        $cariqty2 = $cariqty->toArray();
        $cariqty3 = implode(" ", $cariqty2);

        Fueltake_receiver::where('id_stock', $request->id_stock)
            ->update([
                'qty' => $cariqty3 - $request->qty
            ]);

        return redirect('/fuel-refill');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FuelRefill  $fuelRefill
     * @return \Illuminate\Http\Response
     */
    public function show(FuelRefill $fuelRefill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FuelRefill  $fuelRefill
     * @return \Illuminate\Http\Response
     */
    public function edit(FuelRefill $fuelRefill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFuelRefillRequest  $request
     * @param  \App\Models\FuelRefill  $fuelRefill
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFuelRefillRequest $request, FuelRefill $fuelRefill)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FuelRefill  $fuelRefill
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FuelRefill::destroy($id);

        return redirect('/fuel-refill');
    }
}
