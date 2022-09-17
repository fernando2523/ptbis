<?php

namespace App\Http\Controllers\vehicle;

use App\Models\Vehicle;
use App\Models\Vendor;
use App\Models\Vehicle_history;
use App\Models\Vehicle_Type;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use PDF;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vehicle()
    {
        $title = "Vehicle";

        $datavehicle = DB::table('vehicle')
            ->orderBy('vehicle_id', 'desc')
            ->limit(10)
            ->get();

        $datahistories = DB::table('vehicle')
            ->orderBy('vehicle_id', 'desc')
            ->limit(5)
            ->get();

        $getvendor = Vendor::join('contracts', 'contracts.id_vendor', '=', 'vendors.id_vendor')
            ->where('contracts.type_vendor', '!=', 'Land')
            ->select('vendors.id_vendor', 'vendors.vendor')
            ->get();

        $countowned = DB::table('vehicle')
            ->where('type_unit', '=', 'OWNED')
            ->count('type_unit');

        $countvendor = DB::table('vehicle')
            ->where('type_unit', '=', 'CONTRACT')
            ->count('type_unit');

        $cek = Vehicle::count();
        if ($cek === 0) {
            $urut = 1001;
            $idvhc = 'VHC-' . $urut;
        } else {
            $ambildata = Vehicle::all()->max('vehicle_id');
            $urut = (int)trim($ambildata, "VHC-") + 1;
            $idvhc = 'VHC-' . $urut;
        }

        return view('vehicle.vehicles', compact(
            'datavehicle',
            'title',
            'idvhc',
            'datahistories',
            'getvendor',
            'countowned',
            'countvendor',
        ));
    }

    public function datatablevehicle(Request $request)
    {
        if ($request->ajax()) {
            $data = Vehicle::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action_contract', function () {
                })
                ->addColumn('action', function () {
                })
                ->rawColumns(['action_contract', 'action'])
                ->make(true);
        }
    }

    // public function datatablevehicle_exp(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Vehicle_history::latest()->where('contract', '=', 'EXPIRED DAYS')->get();
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function () {
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    // public function datatablevehicle_hour(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data2 = Vehicle_history::latest()->where('contract', '=', 'HOUR METER')->get();
    //         return DataTables::of($data2)
    //             ->addIndexColumn()
    //             ->addColumn('action', function () {
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    // public function datatablevehicle_ritase(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data3 = Vehicle_history::latest()->where('contract', '=', 'RITASE')->get();
    //         return DataTables::of($data3)
    //             ->addIndexColumn()
    //             ->addColumn('action', function () {
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    // }

    public function view_pdf($path)
    {
        $notice = Vehicle_history::where('path', $path)->firstOrFail();
        $pathToFile = $notice->file;
        $fileName =  $notice->fileName;
        $path = $pathToFile . 'files/' . $path;
        $file = public_path($path . $fileName);
        return response()->file($file);
    }

    // public function historyasset()
    // {
    //     $title = "Vehicle History";
    //     $historyexp = DB::table('vehicle_histories')
    //         ->where('contract', '=', 'EXPIRED DAYS')
    //         ->orderBy('id', 'desc')
    //         ->limit(20)
    //         ->get();

    //     $historyhm = DB::table('vehicle_histories')
    //         ->where('contract', '=', 'HOUR METER')
    //         ->orderBy('id', 'desc')
    //         ->limit(20)
    //         ->get();

    //     $historyrit = DB::table('vehicle_histories')
    //         ->where('contract', '=', 'RITASE')
    //         ->orderBy('id', 'desc')
    //         ->limit(20)
    //         ->get();

    //     return view('vehicle/history', compact(
    //         'title',
    //         'historyexp',
    //         'historyhm',
    //         'historyrit'
    //     ));
    // }

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
        $GETIDENTITY = $request->type_vehicle;

        if ($GETIDENTITY === "MOBIL") {
            $cek = Vehicle_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = 'LV-' . sprintf("%02s", $urut);

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->mb = $urut;
                $addtype->save();
            } else {
                $ambildata = Vehicle_Type::all()->max('mb');
                $ambilint = $ambildata + 1;
                $idss = 'LV-' . sprintf("%02s", ($ambildata + 1));

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->mb = $ambilint;
                $addtype->save();
            }
        } else if ($GETIDENTITY === "MOTOR") {
            $cek2 = Vehicle_Type::count();
            if ($cek2 === 0) {
                $urut2 = 1;
                $idss = "MT-" . sprintf("%02s", $urut2);

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->mt = $urut2;
                $addtype->save();
            } else {
                $ambildata2 = Vehicle_Type::all()->max('mt');
                $ambilint = $ambildata2 + 1;
                $idss = 'MT-' . sprintf("%02s", ($ambildata2 + 1));

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->mt = $ambilint;
                $addtype->save();
            }
        } else if ($GETIDENTITY === "DUMP TRUCK") {
            $cek = Vehicle_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "DT-" . sprintf("%02s", $urut);

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->dt = $urut;
                $addtype->save();
            } else {
                $ambildata = Vehicle_Type::all()->max('dt');
                $ambilint = $ambildata + 1;
                $idss = 'DT-' . sprintf("%02s", ($ambildata + 1));

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->dt = $ambilint;
                $addtype->save();
            }
        } else if ($GETIDENTITY === "EXCAVATOR") {
            $cek = Vehicle_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "EX-" . sprintf("%02s", $urut);

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->ex = $urut;
                $addtype->save();
            } else {
                $ambildata = Vehicle_Type::all()->max('ex');
                $ambilint = $ambildata + 1;
                $idss = 'EX-' . sprintf("%02s", ($ambildata + 1));

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->ex = $ambilint;
                $addtype->save();
            }
        } else if ($GETIDENTITY === "BULLDOZER") {
            $cek = Vehicle_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "DZ-" . sprintf("%02s", $urut);

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->dz = $urut;
                $addtype->save();
            } else {
                $ambildata = Vehicle_Type::all()->max('dz');
                $ambilint = $ambildata + 1;
                $idss = 'DZ-' . sprintf("%02s", ($ambildata + 1));

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->dz = $ambilint;
                $addtype->save();
            }
        } else if ($GETIDENTITY === "DUMP TRUCK EXTERNAL") {
            $cek = Vehicle_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "DTE-" . sprintf("%02s", $urut);

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->dz = $urut;
                $addtype->save();
            } else {
                $ambildata = Vehicle_Type::all()->max('dte');
                $ambilint = $ambildata + 1;
                $idss = 'DTE-' . sprintf("%02s", ($ambildata + 1));

                $addtype = new Vehicle_Type;
                $addtype->vehicle_id = $request->vehicle_id;
                $addtype->type_vehicle = $request->type_vehicle;
                $addtype->dte = $ambilint;
                $addtype->save();
            }
        }

        $getid_vendor = $request->id_vendor;

        $getname_vendor = DB::table('vendors')
            ->where('id_vendor', '=', $getid_vendor)
            ->pluck('vendor');
        $getname_vendor2 = $getname_vendor->toArray();
        $getname_vendor3 = implode(" ", $getname_vendor2);

        if ($request->type_unit === "OWNED") {
            $model = new Vehicle;
            $model->vehicle_id = $request->vehicle_id;
            $model->vehicle_unit = $request->vehicle_unit;
            $model->operator = $request->operator;
            $model->type_unit = $request->type_unit;
            $model->users = $request->users;
            $model->type_vehicle = $idss;
            $model->model_unit = $request->model_unit;
            $model->status = "OWNED";
            $model->id_vendor = $getid_vendor;
            $model->vendor = $getname_vendor3;
            $model->save();
            return redirect('/vehicle/vehicles');
        } else {
            // vehicle model
            $model = new Vehicle;
            $model->vehicle_id = $request->vehicle_id;
            $model->vehicle_unit = $request->vehicle_unit;
            $model->operator = $request->operator;
            $model->type_unit = $request->type_unit;
            $model->users = $request->users;
            $model->type_vehicle = $idss;
            $model->model_unit = $request->model_unit;
            $model->status = "ACTIVE";
            $model->id_vendor = $getid_vendor;
            $model->vendor = $getname_vendor3;
            $model->save();

            // $histories = new Vehicle_history;
            // $histories->vehicle_id = $request->vehicle_id;
            // $histories->vehicle_unit = $request->vehicle_unit;
            // $histories->operator = $request->operator;


            // if ($request->contract === "EXPIRED DAYS") {
            //     $newDateTime = Carbon::now('Asia/Bangkok')->addDays($request->days);
            //     $hasildays = $newDateTime->toDateString();
            //     $histories->days = $hasildays;
            // } elseif ($request->contract === "HOUR METER") {
            //     $histories->days = "";
            // } elseif ($request->contract === "RITASE") {
            //     $histories->days = "";
            // }

            // if (empty($_FILES['file']['name'][0])) {
            //     $histories->path = "";
            // } else {
            //     // get file
            //     $request->validate([
            //         'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            //     ]);
            //     $fileName = time() . '.' . $request->file->extension();
            //     $request->file->move(public_path('files'), $fileName);
            //     // end get files
            //     $histories->path = $fileName;
            // }

            // $histories->contract = $request->contract;
            // $histories->price = $request->price;
            // $histories->status = $request->status;
            // $histories->users = $request->users;
            // $histories->model_unit = $request->model_unit;
            // $histories->save();

            // redirect
            return redirect('/vehicle/vehicles');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    public function editact(Request $request, $id)
    {
        $getid_vendor = $request->e_vendor;

        $getname_vendor = DB::table('vendors')
            ->where('id_vendor', '=', $getid_vendor)
            ->pluck('vendor');
        $getname_vendor2 = $getname_vendor->toArray();
        $getname_vendor3 = implode(" ", $getname_vendor2);

        $edit2 = Vehicle::find($id);
        $edit2->vehicle_unit = $request->e_vehicle_unit;
        $edit2->operator = $request->e_operator;
        $edit2->model_unit = $request->e_model_unit;
        $edit2->type_unit = $request->e_type_unit;
        $edit2->id_vendor = $request->e_vendor;
        $edit2->vendor = $getname_vendor3;
        $edit2->update();

        // Vehicle_history::where('vehicle_id', $request->e_vehicle_id)
        //     ->update([
        //         'vehicle_unit' => $request->e_vehicle_unit,
        //         'operator' => $request->e_operator
        //     ]);

        return redirect('/vehicle/vehicles');
    }

    public function contractact(Request $request, $id)
    {
        $edit2 = Vehicle::find($id);
        $edit2->status = $request->con_status;
        $edit2->update();

        Vehicle_history::where('vehicle_id', $request->con_vehicle_id)
            ->update([
                'status' => $request->con_status,
            ]);

        return redirect('/vehicle/vehicles');
    }

    // public function edithistoryact(Request $request, $id)
    // {

    //     $newDateTime = Carbon::parse($request->e_days)->addDays($request->e_daysnew);
    //     $hasildays = $newDateTime->toDateString();

    //     $edit2 = Vehicle_history::find($id);
    //     $edit2->days = $hasildays;
    //     $edit2->update();

    //     return redirect('/vehicle/history');
    // }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Vehicle::destroy($id);

        DB::table('vehicle__types')->where('vehicle_id', $request->del_vehicle_id)->delete();

        return redirect('/vehicle/vehicles');
    }
}
