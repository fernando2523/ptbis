<?php

namespace App\Http\Controllers\production;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function production()
    {
        $title = "Production";

        $datahistories = DB::table('stock_doms')
            ->orderBy('id_dom', 'desc')
            ->limit(5)
            ->get();



        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');

        $gettotal = DB::table('stock_doms')
            ->wheredate('created_at', '=', $tanggalskrg)
            ->sum('bucket');

        $getreadyhauling = DB::table('stock_doms')
            ->sum('bucket');

        return view('production.productions', compact(
            'title',
            'datahistories',
            'gettotal',
            'getreadyhauling'
        ));
    }

    public function load_production(Request $request)
    {
        if ($request->ajax()) {
            $start = $_POST['start'];
            $end = $_POST['end'];
            // $dataproduction = DB::table('stock_doms')
            //     ->leftjoin('locations', 'locations.id_location', '=', 'stock_doms.id_location')
            //     ->whereBetween('date', [$start, $end])
            //     ->select('locations.location', DB::raw('SUM(stock_doms.bucket)*1.69 as volumes'))
            //     ->orderBy('locations.location', 'desc')
            //     ->groupBy('locations.location')
            //     ->get();

            $dataproduction = DB::table('locations')
                ->leftjoin('stock_doms', 'stock_doms.id_location', '=', 'locations.id_location')
                ->where('locations.location', 'LIKE', '%PIT%')
                // ->whereBetween('stock_doms.date', [$start, $end])
                ->select(
                    DB::raw('locations.location'),
                    DB::raw('SUM(stock_doms.bucket)*1.69 as volumes'),
                    DB::raw('SUM(stock_doms.bucket) as bucks'),
                    DB::raw('COUNT(stock_doms.id_dom) as domss'),
                )
                ->orderBy('locations.location', 'desc')
                ->groupBy('locations.location')
                ->get();

            // $getbucket = DB::table('stock_doms')
            //     ->leftjoin('locations', 'locations.id_location', '=', 'stock_doms.id_location')
            //     ->whereBetween('date', [$start, $end])
            //     ->select(
            //         DB::raw('SUM(bucket) as bucks'),
            //         DB::raw('COUNT(id_dom) as domss'),
            //         DB::raw('locations.location'),
            //         DB::raw('bucket'),
            //         DB::raw('id_dom'),
            //     )
            //     ->get();
        }

        return view('/load/load_production', compact(
            'dataproduction',
            'start',
            'end'
        ));
    }

    public function detail(Request $request, $id)
    {
        $title = "Production Detail";

        $data =  DB::table('stock_doms')
            ->where('location', '=', $id)
            ->groupBy('code_sample', 'date')
            ->orderBy('date', 'asc')
            ->orderBy('code_sample', 'asc')
            ->get();

        $gettotal = DB::table('stock_doms')
            ->where('location', '=', $id)
            ->sum('bucket');

        $getsm = DB::table('stock_doms')
            ->where('location', '=', $id)
            ->count('code_sample');

        $getpit = $id;

        return view('production.detail', compact(
            'title',
            'getpit',
            'gettotal',
            'data',
            'getsm'
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
        //
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
