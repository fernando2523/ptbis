<?php

namespace App\Http\Controllers\location;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Orestock;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function location()
    {
        $title = "Location";

        $dataloc = DB::table('locations')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $getvendor = Vendor::join('contracts', 'contracts.id_vendor', '=', 'vendors.id_vendor')
            ->where('contracts.type_vendor', '=', 'Land')
            ->select('vendors.id_vendor', 'vendors.vendor', 'contracts.name_product')
            ->get();

        $cek = Location::count();
        if ($cek === 0) {
            $urut = 1001;
            $idloc = 'LOC-' . $urut;
        } else {
            $ambildata = Location::all()->max('id_location');
            $urut = (int)trim($ambildata, "LOC-") + 1;
            $idloc = 'LOC-' . $urut;
        }

        return view('location.locations', compact(
            'title',
            'dataloc',
            'idloc',
            'getvendor'
        ));
    }

    public function datatablelocation(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::latest()->get();
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
     * *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $get_id_vendor = $request->id_vendor;

        $pic2 = DB::table('vendors')
            ->where('id_vendor', '=', $get_id_vendor)
            ->pluck('vendor');
        $pic3 = $pic2->toArray();
        $pic4 = implode(" ", $pic3);

        $name_land2 = DB::table('vendors')
            ->where('id_vendor', '=', $get_id_vendor)
            ->pluck('name_product');
        $name_land3 = $name_land2->toArray();
        $name_land4 = implode(" ", $name_land3);

        $data = new Location();
        $data->id_location = $request->id_location;
        $data->id_vendor = $get_id_vendor;
        $data->vendor = $pic4;
        $data->name_land = $name_land4;
        $data->location = $request->location;
        $data->lat = $request->lat;
        $data->long = $request->long;
        $data->users = $request->users;
        $data->save();

        $cek = Orestock::count();
        if ($cek === 0) {
            $urut = 1001;
            $idore = 'ORE-' . $urut;
        } else {
            $ambildata = Orestock::all()->max('id_orestock');
            $urut = (int)trim($ambildata, "ORE-") + 1;
            $idore = 'ORE-' . $urut;
        }

        $data2 = new Orestock();
        $data2->id_orestock = $idore;
        $data2->id_location = $request->id_location;
        $data2->loc = $request->location;
        $data2->stock = "0";
        $data2->save();

        return redirect('location/locations');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    public function editact(Request $request, $id)
    {
        $get_id_vendor = $request->id_vendor;
        $getidloc = $request->e_id_location;

        $pic2 = DB::table('vendors')
            ->where('id_vendor', '=', $get_id_vendor)
            ->pluck('vendor');
        $pic3 = $pic2->toArray();
        $pic4 = implode(" ", $pic3);

        $name_land2 = DB::table('vendors')
            ->where('id_vendor', '=', $get_id_vendor)
            ->pluck('name_product');
        $name_land3 = $name_land2->toArray();
        $name_land4 = implode(" ", $name_land3);

        $data = Location::find($id);
        $data->id_vendor = $get_id_vendor;
        $data->vendor = $pic4;
        $data->name_land = $name_land4;
        $data->location = $request->e_location;
        $data->lat = $request->e_lat;
        $data->long = $request->e_long;
        $data->update();

        Orestock::where('id_location', $getidloc)
            ->update([
                'loc' => $request->e_location,
            ]);

        return redirect('/location/locations');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocationRequest  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocationRequest $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Location::destroy($id);

        return redirect('/location/locations');
    }
}
