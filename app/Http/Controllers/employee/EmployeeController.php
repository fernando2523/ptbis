<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\Employee_Type;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employees()
    {
        $title = "Employee";

        $datauser = DB::table('employees')->paginate(6);

        $getuser = DB::table('users')
            ->get();

        return view('employee.employees', compact(
            'title',
            'datauser',
            'getuser'
        ));
    }


    public function cari(Request $request)
    {
        $title = "Employee";
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $datauser = DB::table('employees')
            ->where('name', 'like', "%" . $cari . "%")
            ->paginate(6);

        $getuser = DB::table('users')
            ->get();
        // mengirim data pegawai ke view index
        return view('employee.employees', compact(
            'title',
            'datauser',
            'getuser'
        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function main()
    {
        $getphoto = DB::table('employees')
            ->where('nik', '=', auth::user()->email)
            ->select('img')
            ->get();
        // mengirim data pegawai ke view index
        return view('layouts.main', compact(
            'getphoto'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Bangkok');
        $thn = $now->format('y');
        $bln = $now->format('m');
        $thnbulan = $thn . $bln;

        $GETIDENTITY = $request->role;

        if ($GETIDENTITY === "STAFF-ASSET") {
            $cek = Employee_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "BSO" . $thnbulan . "0" . $urut;
            } else {
                $ambildata = Employee_Type::all()->max('bso');
                $urut = (int)substr($ambildata, -2) + 1;
                $idss = "BSO" . $thnbulan . "0" . $urut;
            }
            $addtype = new Employee_Type;
            $addtype->nik = $idss;
            $addtype->type_user = $request->role;
            $addtype->bso = $idss;
            $addtype->save();
        } else if ($GETIDENTITY === "STAFF-ADMIN") {
            $cek = Employee_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "BSA" . $thnbulan . "0" . $urut;
            } else {
                $ambildata = Employee_Type::all()->max('bsa');
                $urut = (int)substr($ambildata, -2) + 1;
                $idss = "BSA" . $thnbulan . "0" . $urut;
            }
            $addtype = new Employee_Type;
            $addtype->nik = $idss;
            $addtype->type_user = $request->role;
            $addtype->bsa = $idss;
            $addtype->save();
        } else if ($GETIDENTITY === "STAFF-IT") {
            $cek = Employee_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "BSIT" . $thnbulan . "0" . $urut;
            } else {
                $ambildata = Employee_Type::all()->max('bsit');
                $urut = (int)substr($ambildata, -2) + 1;
                $idss = "BSIT" . $thnbulan . "0" . $urut;
            }
            $addtype = new Employee_Type;
            $addtype->nik = $idss;
            $addtype->type_user = $request->role;
            $addtype->bsit = $idss;
            $addtype->save();
        } else if ($GETIDENTITY === "HEAD-SECURITY") {
            $cek = Employee_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "BSF" . $thnbulan . "0" . $urut;
            } else {
                $ambildata = Employee_Type::all()->max('bsf');
                $urut = (int)substr($ambildata, -2) + 1;
                $idss = "BSF" . $thnbulan . "0" . $urut;
            }
            $addtype = new Employee_Type;
            $addtype->nik = $idss;
            $addtype->type_user = $request->role;
            $addtype->bsf = $idss;
            $addtype->save();
        } else if ($GETIDENTITY === "SECURITY") {
            $cek = Employee_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "BSF" . $thnbulan . "0" . $urut;
            } else {
                $ambildata = Employee_Type::all()->max('bsf');
                $urut = (int)substr($ambildata, -2) + 1;
                $idss = "BSF" . $thnbulan . "0" . $urut;
            }
            $addtype = new Employee_Type;
            $addtype->nik = $idss;
            $addtype->type_user = $request->role;
            $addtype->bsf = $idss;
            $addtype->save();
        } else if ($GETIDENTITY === "DRIVER") {
            $cek = Employee_Type::count();
            if ($cek === 0) {
                $urut = 1;
                $idss = "BSF" . $thnbulan . "0" . $urut;
            } else {
                $ambildata = Employee_Type::all()->max('bsf');
                $urut = (int)substr($ambildata, -2) + 1;
                $idss = "BSF" . $thnbulan . "0" . $urut;
            }
            $addtype = new Employee_Type;
            $addtype->nik = $idss;
            $addtype->type_user = $request->role;
            $addtype->bsf = $idss;
            $addtype->save();
        }

        $adduser = new Employee;
        // end get days
        if (empty($_FILES['file']['name'][0])) {
            $adduser->img = null;
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('user'), $fileName);
            // end get files
            $adduser->img = $fileName;
        }

        $adduser->nik = $idss;
        $adduser->name = $request->names;
        $adduser->tlp = $request->tlp;
        $adduser->domisili = $request->domisili;
        $adduser->gender = $request->gender;
        $adduser->role = $request->role;
        $adduser->save();

        return redirect('employee/employees');
    }

    public function editact(Request $request, $id)
    {
        $edit2 = Employee::find($id);

        // end get days
        if (empty($_FILES['file']['name'][0])) {
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('user'), $fileName);
            // end get files
            $edit2->img = $fileName;
        }

        $edit2->name = $request->e_name;
        $edit2->tlp = $request->e_tlp;
        $edit2->domisili = $request->e_domisili;
        $edit2->gender = $request->e_gender;
        $edit2->update();

        return redirect('employee/employees');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table('users')->where('email', $request->del_nik)->delete();

        return redirect('employee/employees');
    }

    public function destroy_employee(Request $request, $id)
    {
        Employee::destroy($id);
        DB::table('users')->where('email', $request->delacc_nik)->delete();
        DB::table('employee__types')->where('nik', $request->delacc_nik)->delete();

        return redirect('employee/employees');
    }
}
