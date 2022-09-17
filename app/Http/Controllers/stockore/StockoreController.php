<?php

namespace App\Http\Controllers\stockore;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Models\Orestock;
use App\Models\Stock_cargo;

class StockoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stockore()
    {
        $title = "Stock Cargo";

        $stock = DB::table('stock_cargos')
            ->orderBy('id', 'desc')
            ->get();

        $getlocation = DB::table('locations')
            ->select('id_location', 'location')
            ->get();

        return view('stockore.stockores', compact(
            'title',
            'stock',
            'getlocation'
        ));
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
        $cek = Stock_cargo::count();
        if ($cek === 0) {
            $urut = 1001;
            $idcarg = 'CARG-' . $urut;
        } else {
            $ambildata = Stock_cargo::all()->max('id_cargo');
            $urut = (int)trim($ambildata, "CARG-") + 1;
            $idcarg = 'CARG-' . $urut;
        }
        $getcategory = $request->category;

        if ($getcategory === "CARGO PRODUCTION") {
            $getidloc = $request->id_location_production;
            $getlocation = DB::table('locations')
                ->where('id_location', '=', $getidloc)
                ->pluck('location');
            $getlocation2 = $getlocation->toArray();
            $getlocation3 = implode(" ", $getlocation2);

            $data = new Stock_cargo();
            $data->id_cargo = $idcarg;
            $data->category = $getcategory;
            $data->id_location = $getidloc;
            $data->loc = $getlocation3;
            $data->estimated = "0";
            $data->in_bucket = $request->in_bucket;
            $data->in_ritase = $request->in_ritase;
            $data->in_volume_bucket = $request->in_volume_bucket;

            $data->out_bucket = "0";
            $data->out_ritase = "0";
            $data->out_volume_bucket = "0";
            $data->status = $request->status;
            $data->dome = $request->dome;
            $data->desc = $request->desc;
            $data->save();
        } elseif ($getcategory === "CARGO BUYING") {

            $data = new Stock_cargo();
            $data->id_cargo = $idcarg;
            $data->category = $getcategory;
            $data->id_location = null;
            $data->loc = $request->id_location_buying;
            $data->estimated = $request->estimated;
            $data->in_bucket = "0";
            $data->in_ritase = "0";
            $data->in_volume_bucket = "0";

            $data->out_bucket = "0";
            $data->out_ritase = "0";
            $data->out_volume_bucket = "0";
            $data->status = $request->status;
            $data->dome = $request->dome;
            $data->desc = $request->desc;
            $data->save();
        }

        return redirect('stockore/stockores');
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
        //
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
