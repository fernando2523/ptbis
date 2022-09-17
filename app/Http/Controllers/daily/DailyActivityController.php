<?php

namespace App\Http\Controllers\daily;

use App\Models\Daily_activity;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;

class DailyActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function daily()
    {
        $title = "Daily Activity";

        $cek = Daily_activity::count();
        if ($cek === 0) {
            $urut = 1001;
            $idact = 'ACT-' . $urut;
        } else {
            $ambildata = Daily_activity::all()->max('id_act');
            $urut = (int)trim($ambildata, "ACT-") + 1;
            $idact = 'ACT-' . $urut;
        }

        return view('daily.dailys', compact(
            'title',
            'idact'
        ));
    }

    public function datatabledaily(Request $request)
    {
        if ($request->ajax()) {
            $data = Daily_activity::latest()->get();
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
     * @param  \App\Http\Requests\StoreDaily_activityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Daily_activity();
        $data->id_act = $request->id_act;
        $data->date = $request->date;
        $data->activity = $request->activity;
        $data->desc = $request->desc;
        $data->users = $request->users;
        $data->save();

        return redirect('daily/dailys');
    }

    public function editact(Request $request, $id)
    {
        $data = Daily_activity::find($id);
        $data->id_act = $request->e_id_act;
        $data->activity = $request->e_activity;
        $data->desc = $request->e_desc;
        $data->users = $request->e_users;
        $data->update();


        return redirect('/daily/dailys');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daily_activity  $daily_activity
     * @return \Illuminate\Http\Response
     */
    public function show(Daily_activity $daily_activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daily_activity  $daily_activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Daily_activity $daily_activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDaily_activityRequest  $request
     * @param  \App\Models\Daily_activity  $daily_activity
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDaily_activityRequest $request, Daily_activity $daily_activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daily_activity  $daily_activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Daily_activity::destroy($id);

        return redirect('/daily/dailys');
    }
}
