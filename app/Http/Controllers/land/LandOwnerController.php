<?php

namespace App\Http\Controllers\land;

use App\Http\Controllers\Controller;
use App\Models\LandOwner;
use App\Http\Requests\StoreLandOwnerRequest;
use App\Http\Requests\UpdateLandOwnerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class LandOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function land()
    {
        $title = "Land Owner";

        $dataland = DB::table('land_owners')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->get();

        $cek = LandOwner::count();
        if ($cek === 0) {
            $urut = 1001;
            $idowl = 'OWL-' . $urut;
        } else {
            $ambildata = LandOwner::all()->max('id_land');
            $urut = (int)trim($ambildata, "OWL-") + 1;
            $idowl = 'OWL-' . $urut;
        }

        return view('land.lands', compact(
            'title',
            'dataland',
            'idowl'
        ));
    }

    public function datatableland(Request $request)
    {
        if ($request->ajax()) {
            $data = LandOwner::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function () {
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function view_pdf($path)
    {
        $notice = LandOwner::where('path', $path)->firstOrFail();
        $pathToFile = $notice->file;
        $fileName =  $notice->fileName;
        $path = $pathToFile . 'files/' . $path;
        $file = public_path($path . $fileName);
        return response()->file($file);
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
     *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new LandOwner;
        $model->id_land = $request->id_land;
        $model->owner = $request->owner;
        $model->land = $request->land;
        $model->status_land = $request->status_land;
        $model->royalty = $request->royalty;
        $model->users = $request->users;

        if (empty($_FILES['file']['name'][0])) {
            $model->path = "";
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('files'), $fileName);
            // end get files
            $model->path = $fileName;
        }

        $model->save();

        return redirect('land/lands');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LandOwner  $landOwner
     * @return \Illuminate\Http\Response
     */
    public function show(LandOwner $landOwner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LandOwner  $landOwner
     * @return \Illuminate\Http\Response
     */
    public function edit(LandOwner $landOwner)
    {
        //
    }

    public function editact(Request $request, $id)
    {
        $edit2 = LandOwner::find($id);
        $edit2->owner = $request->e_owner;
        $edit2->land = $request->e_land;
        $edit2->royalty = $request->e_royalty;
        $edit2->update();

        return redirect('/land/lands');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLandOwnerRequest  $request
     * @param  \App\Models\LandOwner  $landOwner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLandOwnerRequest $request, LandOwner $landOwner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LandOwner  $landOwner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LandOwner::destroy($id);

        return redirect('/land/lands');
    }
}
