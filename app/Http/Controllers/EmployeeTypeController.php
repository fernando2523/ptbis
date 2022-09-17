<?php

namespace App\Http\Controllers;

use App\Models\Employee_Type;
use App\Http\Requests\StoreEmployee_TypeRequest;
use App\Http\Requests\UpdateEmployee_TypeRequest;

class EmployeeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreEmployee_TypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee_TypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee_Type  $employee_Type
     * @return \Illuminate\Http\Response
     */
    public function show(Employee_Type $employee_Type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee_Type  $employee_Type
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee_Type $employee_Type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployee_TypeRequest  $request
     * @param  \App\Models\Employee_Type  $employee_Type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee_TypeRequest $request, Employee_Type $employee_Type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee_Type  $employee_Type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee_Type $employee_Type)
    {
        //
    }
}
