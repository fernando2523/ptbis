<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Barging;
use App\Models\Barging_draft;
use Psy\Readline\Hoa\Console;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = "Dashboard";

        return view('dashboard', compact(
            'title',
        ));
    }

    public function load_data(Request $request)
    {
        if ($request->ajax()) {
            $start = $_POST['start'];
            $end = $_POST['end'];

            $fuel_used = DB::table('fuel_refill')
                ->selectRaw('sum(qty) as qty')
                ->whereBetween('created_at', [$start, $end])
                ->get();
            $sumrefill_DT = DB::table('fuel_refill')->where('vehicle_unit', 'like', "%" . 'DT' . "%")->whereBetween('date', [$start, $end])->sum('qty');
            $sumrefill_EX = DB::table('fuel_refill')->where('vehicle_unit', 'like', "%" . 'EX' . "%")->whereBetween('date', [$start, $end])->sum('qty');
            $sumrefill_LV = DB::table('fuel_refill')->where('vehicle_unit', 'like', "%" . 'LV' . "%")->whereBetween('date', [$start, $end])->sum('qty');

            $hour_meter = DB::table('hourmeters')
                ->selectRaw('sum(hm_total) as hm_total')
                ->whereBetween('date', [$start, $end])
                ->get();

            $countunit_hm = DB::table('hourmeters')->whereBetween('date', [$start, $end])->distinct('identify')->count('identify');

            $sumrefill_EX_avg = DB::table('fuel_refill')
                ->selectRaw('sum(qty) as totalfuel')
                ->where('vehicle_unit', 'like', "%" . 'EX' . "%")
                ->whereBetween('date', [$start, $end])
                ->get();

            $avgfuelhours = DB::table('hourmeters')
                ->selectRaw('sum(hm_total) as totalss')
                ->whereBetween('date', [$start, $end])
                ->get();

            if ($sumrefill_EX_avg[0]->totalfuel != null and $avgfuelhours[0]->totalss != null) {
                $total_avg = intval($sumrefill_EX_avg[0]->totalfuel) / intval($avgfuelhours[0]->totalss);
            } else {
                $total_avg = 0;
            }

            $hauling = DB::table('ritases')
                ->selectRaw('count(id) as total')
                ->where('type_activity', '=', 'HAULING')
                ->whereBetween('created_at', [$start, $end])
                ->get();

            $barging = DB::table('ritases')
                ->selectRaw('count(id) as total')
                ->where('type_activity', '=', 'BARGING')
                ->whereBetween('created_at', [$start, $end])
                ->get();

            $countunit_DT = DB::table('ritases')->whereBetween('created_at', [$start, $end])
                ->distinct('identify')
                ->count('identify');

            $countritase = DB::table('ritases')->whereBetween('created_at', [$start, $end])->count('id_ritase');

            if ($sumrefill_DT != null and $countritase != null) {
                $total_avg_DT = intval($sumrefill_DT) / intval($countritase);
            } else {
                $total_avg_DT = 0;
            }

            $production_data = DB::table('stock_doms')
                ->selectRaw('sum(bucket) as total')
                ->whereBetween('date', [$start, $end])
                ->get();

            $countproduction = DB::table('stock_doms')->distinct('id_location')->whereBetween('date', [$start, $end])->count('id_location');
            $countunit = DB::table('hourmeters')->whereBetween('date', [$start, $end])->distinct('identify')->count('identify');

            $production = $production_data['0']->total * 1.60;

            $activity = DB::table('daily_activities')
                ->whereBetween('date', [$start, $end])
                ->get();

            $activity_count = DB::table('daily_activities')
                ->whereBetween('date', [$start, $end])
                ->count('id_act');

            $category = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec');

            $label1 = date("Y", strtotime(' - 2 years'));
            $label2 = date("Y", strtotime(' - 1 years'));
            $label3 = date("Y");

            $data1 = array();
            $data2 = array();
            $data3 = array();

            $m = 1;
            while ($m <= 12) {
                $db_1 = DB::table('stock_doms')
                    ->whereMonth('date', $m)
                    ->whereYear('date', $label1)
                    ->sum('bucket');

                $db_2 = DB::table('stock_doms')
                    ->whereMonth('date', $m)
                    ->whereYear('date', $label2)
                    ->sum('bucket');

                $db_3 = DB::table('stock_doms')
                    ->whereMonth('date', $m)
                    ->whereYear('date', $label3)
                    ->sum('bucket');

                array_push($data1, $db_1 * 1.60);
                array_push($data2, $db_2 * 1.60);
                array_push($data3, $db_3 * 1.60);
                $m++;
            }



            return view('/load/dashboard', compact(
                'start',
                'end',
                'fuel_used',
                'hour_meter',
                'hauling',
                'barging',
                'production',
                'activity',
                'countproduction',
                'countunit',
                'sumrefill_DT',
                'sumrefill_EX',
                'sumrefill_LV',
                'countunit_hm',
                'avgfuelhours',
                'total_avg',
                'countunit_DT',
                'total_avg_DT',
                'category',
                'label1',
                'label2',
                'label3',
                'data1',
                'data2',
                'data3',
                'activity_count'
            ));
        }
    }

    public function load_data_barging(Request $request)
    {
        if ($request->ajax()) {
            $data = $_POST['bulan'];
            $hasil = explode("-", $data);

            $tahun = $hasil[0];
            $bulan = $hasil[1];

            $month_number = date("m", strtotime($bulan));

            $tonase_barg = Barging::join('barging_drafts', 'barging_drafts.id_barg', '=', 'bargings.id_barg')
                ->whereMonth('bargings.created_at', $month_number)
                ->whereYear('bargings.created_at', $tahun)
                ->sum('barging_drafts.tonase');

            $tongkang = Barging::join('barging_drafts', 'barging_drafts.id_barg', '=', 'bargings.id_barg')

                ->whereMonth('bargings.created_at', $month_number)
                ->whereYear('bargings.created_at', $tahun)
                ->count('bargings.id_barg');

            $barg = Barging::join('barging_drafts', 'barging_drafts.id_barg', '=', 'bargings.id_barg')
                ->whereMonth('bargings.created_at', $month_number)
                ->whereYear('bargings.created_at', $tahun)
                ->get();

            return view('/load/barging_load', compact(
                'bulan',
                'tahun',
                'barg',
                'tonase_barg',
                'tongkang'
            ));
        }
    }
}
