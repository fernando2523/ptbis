<?php

namespace App\Http\Controllers\barging;

use Illuminate\Http\Request;
use App\models\Ritase;
use App\Http\Controllers\Controller;
use App\Models\Barging;
use App\models\Departure;
use App\models\Arrival;
use App\Models\Barging_generate;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use PDF;

class BargingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function barging()
    {
        $title = "Barging";

        $getdata = DB::table('bargings')->get();


        $getdata2 = DB::table('ritases')
            ->where('type_activity', '=', 'BARGING')
            ->get();

        $getlocation = DB::table('locations')
            ->get();

        $origin = DB::table('ritases')
            ->select(
                DB::raw('SUM(bucket) as bucket'),
                DB::raw('id_barg'),
                DB::raw('origin'),
            )
            ->where('type_activity', '=', 'BARGING')
            // ->sum('bucket')
            ->groupBy('id_barg', 'origin')
            ->get();

        $departure = DB::table('ritases')
            ->select(
                DB::raw('SUM(bucket) as bucket'),
                DB::raw('id_barg'),
                DB::raw('departure_location'),
            )
            ->where('type_activity', '=', 'BARGING')
            // ->sum('bucket')
            ->groupBy('id_barg', 'departure_location')
            ->get();

        $totalbucket = DB::table('ritases')->where('type_activity', '=', 'BARGING')->sum('bucket');
        $tonaseavg = $totalbucket * 1.689;

        return view('barging.bargings', compact(
            'title',
            'getdata',
            'origin',
            'departure',
            'getdata2',
            'getlocation',
            'tonaseavg'
        ));
    }

    public function load_barging(Request $request)
    {
        if ($request->ajax()) {
            $start = $_POST['start'];
            $end = $_POST['end'];

            $orestock = DB::table('stock_cargos')
                ->where('status', '=', 'READY')
                ->sum('in_bucket');

            $orestockready = DB::table('stock_cargos')
                ->where('status', '=', 'READY')
                ->where('loc', 'LIKE', '%STOCKPILE%')
                ->sum('in_bucket');

            $inprogress = DB::table('bargings')
                ->where('status', '=', 'IN PROGRESS')
                ->whereBetween('start', [$start, $end])
                ->sum('stock');

            $finish = DB::table('bargings')
                ->where('status', '=', 'FINISHED')
                ->whereBetween('start', [$start, $end])
                ->sum('stock');

            return view('/load/load_barging', compact(
                'orestock',
                'orestockready',
                'inprogress',
                'finish'
            ));
        }
    }

    public function ritase($id)
    {
        $title = "Barging Ritase";
        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');

        $dataritase = DB::table('ritases')
            ->where('id_barg', '=', $id)
            ->where('type_activity', '=', 'BARGING')
            ->whereDate('arrival_ts', 'like', '%' . $tanggalskrg . '%')
            ->groupBy('identify')
            ->get();

        $dataritase2 = DB::table('ritases')
            ->where('id_barg', '=', $id)
            ->where('type_activity', '=', 'BARGING')
            ->whereDate('arrival_ts', 'like', '%' . $tanggalskrg . '%')
            ->get();

        $getritase = DB::table('ritases')
            ->where('id_barg', '=', $id)
            ->where('type_activity', '=', 'BARGING')
            ->whereDate('arrival_ts', 'like', '%' . $tanggalskrg . '%')
            ->get();

        $getnama = DB::table('bargings')
            ->where('id_barg', '=', $id)
            ->get();

        return view('barging.ritase', compact(
            'title',
            'dataritase',
            'dataritase2',
            'getritase',
            'getnama'
        ));
    }

    public function detail()
    {
        $title = "Barging Detail";
        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');


        $datahistories = DB::table('ritases')
            ->where('type_activity', '=', 'BARGING')
            ->orderBy('id_ritase', 'desc')
            ->limit(5)
            ->get();

        $totalritase = DB::table('ritases')
            ->where('type_activity', '=', 'BARGING')
            ->whereDate('departure_ts', '=', $tanggalskrg)
            ->count('id_ritase');

        $totalbucket = DB::table('ritases')
            ->where('type_activity', '=', 'BARGING')
            ->whereDate('departure_ts', '=', $tanggalskrg)
            ->sum('bucket');

        $getidentify = DB::table('vehicle')
            ->get();
        $getdeparture = DB::table('locations')
            ->get();
        $getarrival = DB::table('locations')
            ->get();

        return view('barging.detail', compact(
            'title',
            'datahistories',
            'totalritase',
            'totalbucket',
            'getdeparture',
            'getarrival',
            'getidentify'
        ));
    }

    public function datatablebarging(Request $request)
    {
        if ($request->ajax()) {
            $data = Ritase::latest()->where('type_activity', '=', 'BARGING')->get();
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
        $cek = Barging_generate::count();
        if ($cek === 0) {
            $urut = 1;
            $hasil_idbarg = 'BARG-' . $urut;

            $addtype = new Barging_generate;
            $addtype->id_barg = $hasil_idbarg;
            $addtype->generate_id = $urut;
            $addtype->save();
        } else {
            $ambildata = Barging_generate::all()->max('generate_id');
            $ambilint = $ambildata + 1;
            $hasil_idbarg = 'BARG-' . ($ambildata + 1);

            $addtype = new Barging_generate;
            $addtype->id_barg = $hasil_idbarg;
            $addtype->generate_id = $ambilint;
            $addtype->save();
        }

        $now = Carbon::now('Asia/Bangkok')->toDateTimeString();

        $data = new Barging();
        $data->id_barg = $hasil_idbarg;
        $data->loc = $request->loc;
        $data->capacity = $request->capacity;
        $data->stock = "0";
        $data->status = "ON PROGRESS";
        $data->start = $now;
        $data->save();

        return redirect('/barging/bargings');
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
        $getindentify = $request->e_identify;
        $getidform = $request->e_id_form;
        $getarrival = $request->e_arrival_location;
        $getdeparture = $request->e_departure_location;

        $vehicle2 = DB::table('vehicle')
            ->where('type_vehicle', '=', $getindentify)
            ->pluck('model_unit');
        $vehicle3 = $vehicle2->toArray();
        $vehicle4 = implode(" ", $vehicle3);

        $model2 = Ritase::find($id);
        $model2->identify = $request->e_identify;
        $model2->model_unit = $vehicle4;
        $model2->operator = $request->e_operator;
        $model2->material = $request->e_material;
        $model2->bucket = $request->e_bucket;
        $model2->departure_location = $request->e_departure_location;
        $model2->arrival_location = $request->e_arrival_location;
        $model2->update();

        $arriv2 = DB::table('locations')
            ->where('location', '=', $getarrival)
            ->pluck('id_location');
        $arriv3 = $arriv2->toArray();
        $arriv4 = implode(" ", $arriv3);

        Arrival::where('id_form', $getidform)
            ->update([
                'identity' => $request->e_identify,
                'id_location' => $arriv4,
                'location' => $request->e_arrival_location,
            ]);

        $departu2 = DB::table('locations')
            ->where('location', '=', $getdeparture)
            ->pluck('id_location');
        $departu3 = $departu2->toArray();
        $departu4 = implode(" ", $departu3);

        Departure::where('id_form', $getidform)
            ->update([
                'identity' => $request->e_identify,
                'location' => $request->e_departure_location,
                'id_location' => $departu4,
                'bucket' => $request->e_bucket,
                'operator' => $request->e_operator,
                'material' => $request->e_material,
            ]);

        return redirect('/barging/detail');
    }

    public function statusact(Request $request, $id)
    {
        $now = Carbon::now('Asia/Bangkok')->toDateTimeString();

        $databarg = Barging::find($id);
        $databarg->status = "FINISHED";
        $databarg->finish = $now;
        $databarg->update();

        return redirect('/barging/bargings');
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
    public function destroy(Request $request, $id)
    {
        Ritase::destroy($id);

        DB::table('ritases_departure')->where('id_form', $request->del_id_form)->delete();
        DB::table('ritases_arrival')->where('id_form', $request->del_id_form)->delete();

        return redirect('/barging/detail');
    }

    public function destroybarg(Request $request, $id)
    {
        Barging::destroy($id);

        DB::table('barging_generates')->where('id_barg', $request->del_id_barg)->delete();

        return redirect('/barging/bargings');
    }
}
