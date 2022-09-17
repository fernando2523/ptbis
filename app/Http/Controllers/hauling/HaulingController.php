<?php

namespace App\Http\Controllers\hauling;

use Illuminate\Http\Request;
use App\models\Ritase;
use App\models\Departure;
use App\models\Arrival;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;

class HaulingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hauling()
    {
        $title = "Hauling";

        // $getdata = DB::table('ritases')
        //     ->distinct()->select('arrival_location')
        //     ->where('type_activity', '=', 'HAULING')
        //     ->get();

        $getdata = DB::table('ritases')
            ->select(
                DB::raw('SUM(bucket) as totalbucket'),
                DB::raw('arrival_location'),
                DB::raw('created_at'),
            )
            ->where('type_activity', '=', 'HAULING')
            ->groupBy('arrival_location')
            ->get();

        // $hasilmt = $getdata[0]->totalbucket * 1.4;

        $getmtstockpile = DB::table('ritases')
            ->distinct()->select('arrival_location')
            ->where('type_activity', '=', 'HAULING')
            ->sum('bucket');

        $datahistories = DB::table('ritases')
            ->orderBy('id_ritase', 'desc')
            ->limit(10)
            ->get();

        $getdata2 = DB::table('ritases')
            ->select(
                DB::raw('SUM(bucket) as bucket'),
                DB::raw('count(id_ritase) as counts'),
                DB::raw('departure_location'),
                DB::raw('arrival_location'),
            )
            ->where('type_activity', '=', 'HAULING')
            ->groupBy('departure_location', 'arrival_location')
            ->get();

        $origin = DB::table('ritases')
            ->select(
                DB::raw('SUM(bucket) as bucket'),
                DB::raw('arrival_location'),
                DB::raw('origin'),
                DB::raw('count(id_ritase) as countritase'),
            )
            ->where('type_activity', '=', 'HAULING')
            // ->sum('bucket')
            ->groupBy('arrival_location', 'origin')
            ->get();

        $departure = DB::table('ritases')
            ->select(
                DB::raw('SUM(bucket) as bucket'),
                DB::raw('arrival_location'),
                DB::raw('departure_location'),
            )
            ->where('type_activity', '=', 'HAULING')
            // ->sum('bucket')
            ->groupBy('arrival_location', 'departure_location')
            ->get();

        return view('hauling.haulings', compact(
            'title',
            'getdata',
            'getdata2',
            'datahistories',
            'origin',
            'departure'
        ));
    }

    public function load_hauling(Request $request)
    {
        if ($request->ajax()) {
            $start = $_POST['start'];
            $end = $_POST['end'];

            $totalbucket = DB::table('ritases')
                ->where('type_activity', '=', 'HAULING')
                ->whereBetween('created_at', [$start, $end])
                ->sum('bucket');

            $tonaseavg = $totalbucket * 1.49;

            $totalritase = DB::table('ritases')
                ->where('type_activity', '=', 'HAULING')
                ->whereBetween('created_at', [$start, $end])
                ->count('id');

            $fuelused = DB::table('fuel_refill')
                ->where('vehicle_unit', 'LIKE', '%DT%')
                ->whereBetween('created_at', [$start, $end])
                ->sum('qty');

            return view('/load/load_hauling', compact(
                'totalbucket',
                'tonaseavg',
                'totalritase',
                'fuelused'
            ));
        }
    }

    public function ritase(Request $request, $id)
    // public function ritase(Request $request, $id, $start, $end)
    {
        $title = "Hauling Ritase";
        $getnama = $id;

        $dataritase = DB::table('ritases')
            ->where('type_activity', '=', 'HAULING')
            ->where('arrival_location', '=', $getnama)
            // ->whereDate('created_at', 'like', '%' . $start . '%')
            ->groupBy('identify')
            ->get();

        $dataritase2 = DB::table('ritases')
            ->where('type_activity', '=', 'HAULING')
            ->where('arrival_location', '=', $getnama)
            // ->whereDate('created_at', 'like', '%' . $start . '%')
            ->get();

        $getritase = DB::table('ritases')
            ->where('type_activity', '=', 'HAULING')
            ->where('arrival_location', '=', $getnama)
            // ->whereDate('created_at', 'like', '%' . $start . '%')
            ->get();

        return view('hauling.ritase', compact(
            'title',
            'getnama',
            'dataritase',
            'dataritase2',
            'getritase'
        ));
    }


    public function detail()
    {
        $title = "Hauling Detail";
        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');


        $datahistories = DB::table('ritases')
            ->where('type_activity', '=', 'HAULING')
            ->orderBy('id_ritase', 'desc')
            ->limit(5)
            ->get();

        $totalritase = DB::table('ritases')
            ->where('type_activity', '=', 'HAULING')
            ->whereDate('departure_ts', '=', $tanggalskrg)
            ->count('id_ritase');

        $totalbucket = DB::table('ritases')
            ->where('type_activity', '=', 'HAULING')
            ->whereDate('departure_ts', '=', $tanggalskrg)
            ->sum('bucket');

        $getidentify = DB::table('vehicle')
            ->get();
        $getdeparture = DB::table('locations')
            ->get();
        $getarrival = DB::table('locations')
            ->get();

        return view('hauling.detail', compact(
            'title',
            'datahistories',
            'totalritase',
            'totalbucket',
            'getdeparture',
            'getarrival',
            'getidentify'
        ));
    }

    public function datatablehauling(Request $request)
    {
        if ($request->ajax()) {
            $data = Ritase::latest()->where('type_activity', '=', 'HAULING')->get();
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

        return redirect('/hauling/detail');
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

        return redirect('/hauling/detail');
    }
}
