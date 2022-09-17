<?php

namespace App\Http\Controllers;

use App\Models\Vehicle_Type;
use App\Http\Requests\StoreVehicle_TypeRequest;
use App\Http\Requests\UpdateVehicle_TypeRequest;

class VehicleTypeController extends Controller
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
     * @param  \App\Http\Requests\StoreVehicle_TypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicle_TypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle_Type  $vehicle_Type
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle_Type $vehicle_Type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle_Type  $vehicle_Type
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle_Type $vehicle_Type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVehicle_TypeRequest  $request
     * @param  \App\Models\Vehicle_Type  $vehicle_Type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicle_TypeRequest $request, Vehicle_Type $vehicle_Type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle_Type  $vehicle_Type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle_Type $vehicle_Type)
    {
        //
    }
}
