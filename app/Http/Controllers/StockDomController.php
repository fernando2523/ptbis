<?php

namespace App\Http\Controllers;

use App\Models\Stock_dom;
use App\Http\Requests\StoreStock_domRequest;
use App\Http\Requests\UpdateStock_domRequest;

class StockDomController extends Controller
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
     * @param  \App\Http\Requests\StoreStock_domRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStock_domRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock_dom  $stock_dom
     * @return \Illuminate\Http\Response
     */
    public function show(Stock_dom $stock_dom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock_dom  $stock_dom
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock_dom $stock_dom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStock_domRequest  $request
     * @param  \App\Models\Stock_dom  $stock_dom
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStock_domRequest $request, Stock_dom $stock_dom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock_dom  $stock_dom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock_dom $stock_dom)
    {
        //
    }
}
