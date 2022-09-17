<?php

namespace App\Http\Controllers;

use App\Models\Stock_cargo;
use App\Http\Requests\StoreStock_cargoRequest;
use App\Http\Requests\UpdateStock_cargoRequest;

class StockCargoController extends Controller
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
     * @param  \App\Http\Requests\StoreStock_cargoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStock_cargoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock_cargo  $stock_cargo
     * @return \Illuminate\Http\Response
     */
    public function show(Stock_cargo $stock_cargo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock_cargo  $stock_cargo
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock_cargo $stock_cargo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStock_cargoRequest  $request
     * @param  \App\Models\Stock_cargo  $stock_cargo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStock_cargoRequest $request, Stock_cargo $stock_cargo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock_cargo  $stock_cargo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock_cargo $stock_cargo)
    {
        //
    }
}
