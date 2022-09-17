<?php

namespace App\Http\Controllers\Preparation;

use App\Http\Controllers\Controller;
use App\Models\Preparation;
use App\Models\Preparation_analysis;
use App\Models\Stock_dom;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class PreparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function preparation()
    {
        $title = "Preparation";

        $datahistories = DB::table('preparations')
            ->orderBy('id_prepp', 'desc')
            ->limit(10)
            ->get();

        $dataloc = DB::table('locations')
            ->get();

        $data_analisa = DB::table('preparation_analyses')
            ->orderBy('date', 'desc')
            ->get();

        return view('preparation.preparations', compact(
            'title',
            'dataloc',
            'datahistories',
            'data_analisa'
        ));
    }


    public function datatablepreparation(Request $request)
    {
        if ($request->ajax()) {
            $data = Preparation::leftjoin('preparation_analyses', 'preparation_analyses.id_analysis', '=', 'preparations.id_analysis')
                ->select('preparations.date', 'preparations.id_prepp', 'preparations.location', 'preparations.id_dome', 'preparations.code_sample', 'preparation_analyses.ni', 'preparation_analyses.fe', 'preparation_analyses.code_sample_final', 'preparations.status', 'preparations.users', 'preparations.id_analysis', 'preparations.id', 'preparations.date')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function datatablepreparationanalysis(Request $request)
    {
        if ($request->ajax()) {
            $data = Preparation_analysis::latest()->get();
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
        $getlab = strtoupper($request->lab);
        // $getdate = date_format(date_create($request->date), "Ymd");

        $tanggalskrg = Date('Ymd');

        $ceks = Preparation_analysis::max('id_analysis');
        if ($ceks === null) {
            $urut = $getlab . '-' . $tanggalskrg . '-1';
            $idanalysis = $urut;
        } else {
            $test_cek = explode("-", $ceks);
            if ($test_cek[1] === $tanggalskrg) {
                $ambildata = Preparation_analysis::max('id_analysis');
                $cek = explode("-", $ambildata);
                $urut = $cek[2] + 1;
                $idanalysis = $getlab . '-' . $tanggalskrg . '-' . $urut;
            } else {
                $urut = $getlab . '-' . $tanggalskrg . '-1';
                $idanalysis = $urut;
            }
        }

        $data = new Preparation_analysis();
        $data->id_analysis = $idanalysis;
        $data->code_sample_final = $request->code_sample_final;
        $data->date = $request->date;
        $data->ni = $request->ni;
        $data->fe = $request->fe;
        $data->desc = $request->desc;
        $data->users = $request->users;
        $data->increment = $request->increment;

        if (empty($_FILES['file']['name'][0])) {
            $data->path = null;
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('/files'), $fileName);
            // end get files
            $data->path = $fileName;
        }

        $data->save();

        return redirect('/preparation/preparations');
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
        $model2 = Preparation::find($id);
        $model2->location = $request->e_location;
        $model2->sample_mining = $request->e_sample_mining;
        $model2->increment = $request->e_increment;
        $model2->ni = $request->e_ni;
        $model2->fe = $request->e_fe;
        $model2->status = $request->e_status;
        $model2->update();

        return redirect('/preparation/preparations');
    }

    public function edit_analysis_act(Request $request, $id)
    {
        $getfile = $request->file;
        if ($getfile === null  || $getfile === "") {
            $model2 = Preparation_analysis::find($id);
            $model2->date = $request->ea_date;
            $model2->code_sample_final = $request->ea_code_sample_final;
            $model2->ni = $request->ea_ni;
            $model2->fe = $request->ea_fe;
            $model2->increment = $request->ea_incerement;
            $model2->desc = $request->ea_desc;
            $model2->users = $request->ea_users;
            $model2->update();
        } else {
            $model2 = Preparation_analysis::find($id);
            $model2->date = $request->ea_date;
            $model2->code_sample_final = $request->ea_code_sample_final;
            $model2->ni = $request->ea_ni;
            $model2->fe = $request->ea_fe;
            $model2->increment = $request->ea_incerement;
            $model2->desc = $request->ea_desc;
            $model2->users = $request->ea_users;

            if (empty($_FILES['file']['name'][0])) {
                $model2->path = null;
            } else {
                // get file
                $request->validate([
                    'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
                ]);
                $fileName = time() . '.' . $request->file->extension();
                $request->file->move(public_path('/files'), $fileName);
                // end get files
                $model2->path = $fileName;
            }
            $model2->update();
        }

        return redirect('/preparation/preparations');
    }

    public function statusact(Request $request, $id)
    {
        $model2 = Preparation::find($id);
        $model2->id_analysis = $request->st_id_analysis;
        $model2->status = "FINISH";
        $model2->update();

        // Stock_dom::where('location', $getloc)->where('code_sample', $getsm)
        //     ->update([
        //         'ni' => $request->st_ni,
        //         'fe' => $request->st_fe,
        //         'flag_code' => "test",
        //     ]);

        return redirect('/preparation/preparations');
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
        Preparation::destroy($id);

        return redirect('/preparation/preparations');
    }

    public function destroyanalysis($id)
    {
        Preparation_analysis::destroy($id);

        return redirect('/preparation/preparations');
    }
}
