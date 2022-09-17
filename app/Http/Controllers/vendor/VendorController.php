<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Hourmeter;
use App\Models\Vendor;
use App\Models\Contract;
use App\Models\Vehicle;
use App\Models\Ritase;
// use App\Http\Requests\StoreVendorRequest;
// use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use PDF;

use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vendor()
    {
        $title = "Vendor";

        $datavendor = DB::table('vendors')
            // ->orderBy('status', 'asc')
            // ->orderBy('type_vendor', 'asc')
            ->paginate(15);

        $datacontract = DB::table('contracts')
            ->orderBy('status', 'asc')
            // ->orderBy('type_vendor', 'asc')
            ->paginate(15);

        $gethm = Vendor::join('vehicle', 'vehicle.id_vendor', '=', 'vendors.id_vendor')
            ->join('hourmeters', 'hourmeters.identify', '=', 'vehicle.type_vehicle')
            ->join('contracts', 'contracts.id_vendor', '=', 'vendors.id_vendor')
            ->select(
                DB::raw('SUM(hourmeters.hm_total) as totals'),
                DB::raw('hourmeters.identify'),
                DB::raw('hourmeters.vehicle_unit'),
                DB::raw('hourmeters.no_contract'),
                DB::raw('contracts.no_contract'),
            )
            ->whereraw('hourmeters.no_contract = contracts.no_contract')
            ->groupBy('hourmeters.identify', 'hourmeters.no_contract')
            ->get();

        $now = Carbon::now();
        $tanggalskrg = Date('Y-m-d');

        // $draft = Contract::whereMonth('created_at', $now->month)
        //     ->get();
        // dd($draft);

        $getritase = Ritase::join('contracts', 'contracts.no_contract', '=', 'ritases.no_contract')
            // ->join('ritases', 'ritases.identify', '=', 'vehicle.type_vehicle')
            // ->join('contracts', 'contracts.id_vendor', '=', 'vendors.id_vendor')
            ->select(
                DB::raw('COUNT(ritases.id_form) as totals'),
                DB::raw('ritases.identify'),
                DB::raw('ritases.model_unit'),
                // DB::raw('vehicle.id_vendor'),
                DB::raw('contracts.no_contract'),
                DB::raw('ritases.id_form'),
            )
            ->whereraw('ritases.no_contract = contracts.no_contract')
            // ->whereBetween('ritases.created_at', ['contracts.start_days', $tanggalskrg])
            ->groupBy('ritases.identify', 'ritases.no_contract')
            ->get();

        $totalritase = Ritase::join('contracts', 'contracts.no_contract', '=', 'ritases.no_contract')
            ->select(
                DB::raw('COUNT(ritases.id_form) as totals_ritase'),
                DB::raw('contracts.no_contract'),
            )
            ->whereraw('ritases.no_contract = contracts.no_contract')
            ->groupBy('ritases.no_contract')
            ->get();

        $getbarg = Contract::join('barging_drafts', 'barging_drafts.no_contract', '=', 'contracts.no_contract')
            ->where('contracts.payment', '=', 'PAID')
            ->groupBy('barging_drafts.id_barg')
            ->get();

        $cek = Vendor::count();
        if ($cek === 0) {
            $urut = 1001;
            $idven = 'VEN_' . $urut;
        } else {
            $ambildata = Vendor::all()->max('id_vendor');
            $urut = (int)trim($ambildata, "VEN_") + 1;
            $idven = 'VEN_' . $urut;
        }

        $hitung = Vendor::count();


        return view('vendor.vendors', compact(
            'title',
            'datavendor',
            'gethm',
            'getritase',
            'totalritase',
            'getbarg',
            'idven',
            'datacontract',
            'hitung'
        ));
    }

    // public function cari(Request $request)
    // {
    //     $title = "Vendor";
    //     $cari = $request->cari;

    //     // mengambil data dari table pegawai sesuai pencarian data
    //     $datauser = DB::table('vendors')
    //         ->where('vendor', 'like', "%" . $cari . "%")
    //         ->paginate(15);

    //     // mengirim data pegawai ke view index
    //     return view('vendor.vendors', compact(
    //         'title',
    //         'datavendor',
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
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tipe_add = $request->tipe_add;

        if ($tipe_add === "new") {
            $newidven = $request->id_vendor;

            $getstart = date('Y-m-d', strtotime($request->start));
            $getcontract = $request->contract;

            $newDateTime = Carbon::parse($getstart)->addDays($request->days);
            $hasildays = $newDateTime->toDateString();

            $idcont_new = 'CONT-' . $newidven . "-" . "1";
            if ($getcontract === "EXPIRED DAYS") {
                $datakontrak = new Contract();
                $datakontrak->no_contract = $idcont_new;
                $datakontrak->id_vendor = $newidven;
                $datakontrak->pic_vendor = $request->pic_vendor;
                $datakontrak->type_vendor = $request->type_vendor;
                $datakontrak->name_product = $request->name_product;
                $datakontrak->contract = $getcontract;
                $datakontrak->contract_agreement = $request->contract_agreement;
                $datakontrak->qty = null;
                $datakontrak->amount = $request->amount;
                $datakontrak->total_amount = null;
                $datakontrak->start_days = $getstart;
                $datakontrak->end_days = $hasildays;
                $datakontrak->status = "ACTIVE";
                $datakontrak->payment = null;
                $datakontrak->users = $request->users;
            }
            if ($getcontract === "HOUR METER") {
                $datakontrak = new Contract();
                $datakontrak->no_contract = $idcont_new;
                $datakontrak->id_vendor = $newidven;
                $datakontrak->pic_vendor = $request->pic_vendor;
                $datakontrak->type_vendor = $request->type_vendor;
                $datakontrak->name_product = $request->name_product;
                $datakontrak->contract = $getcontract;
                $datakontrak->contract_agreement = $request->hours;
                $datakontrak->qty = $request->qty;
                $datakontrak->amount = $request->amount;
                $datakontrak->total_amount = ($request->hours * $request->amount) * $request->qty;
                $datakontrak->start_days = $getstart;
                $datakontrak->end_days = $hasildays;
                $datakontrak->status = "ACTIVE";
                $datakontrak->payment = null;
                $datakontrak->users = $request->users;
            }
            if ($getcontract === "RITASE") {
                $datakontrak = new Contract();
                $datakontrak->no_contract = $idcont_new;
                $datakontrak->id_vendor = $newidven;
                $datakontrak->pic_vendor = $request->pic_vendor;
                $datakontrak->type_vendor = $request->type_vendor;
                $datakontrak->name_product = $request->name_product;
                $datakontrak->contract = $getcontract;
                $datakontrak->contract_agreement = $request->contract_agreement;
                $datakontrak->qty = $request->qty;
                $datakontrak->amount = $request->amount;
                $datakontrak->total_amount = ($request->amount * $request->qty);
                $datakontrak->start_days = $getstart;
                $datakontrak->end_days = $hasildays;
                $datakontrak->status = "ACTIVE";
                $datakontrak->payment = null;
                $datakontrak->users = $request->users;
            }
            if (empty($_FILES['file']['name'][0])) {
                $datakontrak->path = null;
            } else {
                // get file
                $request->validate([
                    'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                ]);
                $fileName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('/files'), $fileName);
                // end get files
                $datakontrak->path = $fileName;
            }
            $data = new Vendor();
            $data->id_vendor = $newidven;
            $data->vendor = $request->vendor;
            $data->address = $request->address;
            $data->users = $request->users;
            $data->save();
        } elseif ($tipe_add === "extend") {
            $getidven = $request->get_id_vendor;

            $getstart = date('Y-m-d', strtotime($request->ext_start));
            $getcontract = $request->ext_contract;

            $newDateTime = Carbon::parse($getstart)->addDays($request->ext_days);
            $hasildays = $newDateTime->toDateString();

            $cek2 = Contract::all()->where('id_vendor', '=', $getidven)->count();
            if ($cek2 === 0) {
                $urut2 = 1;
                $idcont = 'CONT-' . $getidven . "-" . $urut2;
            } else {
                $ambildata2 = Contract::all()->where('id_vendor', '=', $getidven)->max('no_contract');
                $urut2 = substr($ambildata2, 14) + 1;
                $idcont = 'CONT-' . $getidven . "-" . $urut2;
            }

            if ($getcontract === "EXPIRED DAYS") {
                $datakontrak = new Contract();
                $datakontrak->no_contract = $idcont;
                $datakontrak->id_vendor = $getidven;
                $datakontrak->pic_vendor = $request->ext_pic_vendor;
                $datakontrak->type_vendor = $request->ext_type_vendor;
                $datakontrak->name_product = $request->ext_name_product;
                $datakontrak->contract = $getcontract;
                $datakontrak->contract_agreement = $request->ext_contract_agreement;
                $datakontrak->qty = null;
                $datakontrak->amount = $request->ext_amount;
                $datakontrak->total_amount = null;
                $datakontrak->start_days = $getstart;
                $datakontrak->end_days = $hasildays;
                $datakontrak->status = "ACTIVE";
                $datakontrak->payment = null;
                $datakontrak->users = $request->ext_users;
            }
            if ($getcontract === "HOUR METER") {
                $datakontrak = new Contract();
                $datakontrak->no_contract = $idcont;
                $datakontrak->id_vendor = $getidven;
                $datakontrak->pic_vendor = $request->ext_pic_vendor;
                $datakontrak->type_vendor = $request->ext_type_vendor;
                $datakontrak->name_product = $request->ext_name_product;
                $datakontrak->contract = $getcontract;
                $datakontrak->contract_agreement = $request->ext_hours;
                $datakontrak->qty = $request->ext_qty;
                $datakontrak->amount = $request->ext_amount;
                $datakontrak->total_amount = ($request->ext_hours * $request->ext_amount) * $request->ext_qty;
                $datakontrak->start_days = $getstart;
                $datakontrak->end_days = $hasildays;
                $datakontrak->status = "ACTIVE";
                $datakontrak->payment = null;
                $datakontrak->users = $request->ext_users;
            }
            if ($getcontract === "RITASE") {
                $datakontrak = new Contract();
                $datakontrak->no_contract = $idcont;
                $datakontrak->id_vendor = $getidven;
                $datakontrak->pic_vendor = $request->ext_pic_vendor;
                $datakontrak->type_vendor = $request->ext_type_vendor;
                $datakontrak->name_product = $request->ext_name_product;
                $datakontrak->contract = $getcontract;
                $datakontrak->contract_agreement = $request->ext_contract_agreement;
                $datakontrak->qty = $request->ext_qty;
                $datakontrak->amount = $request->ext_amount;
                $datakontrak->total_amount = ($request->ext_amount * $request->ext_qty);
                $datakontrak->start_days = $getstart;
                $datakontrak->end_days = $hasildays;
                $datakontrak->status = "ACTIVE";
                $datakontrak->payment = null;
                $datakontrak->users = $request->ext_users;
            }
            if (empty($_FILES['ext_file']['name'][0])) {
                $datakontrak->path = null;
            } else {
                // get file
                $request->validate([
                    'ext_file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                ]);
                $fileName = time() . '.' . $request->ext_file->extension();
                $request->ext_file->move(public_path('/files'), $fileName);
                // end get files
                $datakontrak->path = $fileName;
            }
        }
        $datakontrak->save();

        return redirect('/vendor/vendors');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorRequest  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
