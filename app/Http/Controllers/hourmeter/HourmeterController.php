<?php

namespace App\Http\Controllers\hourmeter;

use App\Models\Hourmeter;
use App\Http\Requests\StoreHourmeterRequest;
use App\Http\Requests\UpdateHourmeterRequest;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HourmeterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hourmeter()
    {
        $title = "Hour Meter";

        $datahm = DB::table('hourmeters')
            ->paginate(4);

        $countready = DB::table('vehicle')
            ->where('status', '=', 'ACTIVE')
            ->where('type_vehicle', 'like', '%EX%')
            ->count('vehicle_id');

        $countstandby = DB::table('vehicle')
            ->where('status', '=', 'STANDY BY')
            ->where('type_vehicle', 'like', '%EX%')
            ->count('vehicle_id');

        $countall = DB::table('vehicle')
            ->count('vehicle_id');

        return view('hourmeter.hourmeters', compact(
            'title',
            'datahm',
            'countready',
            'countall',
            'countstandby'
        ));
    }
    public function cari(Request $request)
    {
        $title = "Hour Meter";
        $cari = $request->cari;


        $datahm = DB::table('hourmeters')
            ->where('identify', 'like', "%" . $cari . "%")
            ->paginate(4);

        return view('hourmeter.hourmeters', compact(
            'title',
            'datahm',
        ));
    }

    public function hmreport()
    {
        $title = "HM Report";

        $datahm = DB::table('hourmeters');

        $gettotalhm = DB::table('hourmeters')
            ->sum('hm_total');

        // $gettotalfuel = DB::table('hourmeters')
        //     ->sum('consumption');

        $datahistories = DB::table('hourmeters')
            ->orderBy('id_hm', 'desc')
            ->limit(5)
            ->get();

        return view('hourmeter.hm-report', compact(
            'title',
            'datahm',
            'datahistories',
            'gettotalhm',
            //'gettotalfuel'
        ));
    }

    public function datatablehourmeter(Request $request)
    {
        if ($request->ajax()) {
            $data = Hourmeter::latest()->get();
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
     * @param  \App\Http\Requests\StoreHourmeterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHourmeterRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hourmeter  $hourmeter
     * @return \Illuminate\Http\Response
     */
    public function show(Hourmeter $hourmeter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hourmeter  $hourmeter
     * @return \Illuminate\Http\Response
     */
    public function edit(Hourmeter $hourmeter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHourmeterRequest  $request
     * @param  \App\Models\Hourmeter  $hourmeter
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHourmeterRequest $request, Hourmeter $hourmeter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hourmeter  $hourmeter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hourmeter $hourmeter)
    {
        //
    }
}
