<?php

namespace App\Http\Controllers;

use App\Models\History_sync;
use App\Http\Requests\StoreHistory_syncRequest;
use App\Http\Requests\UpdateHistory_syncRequest;

class HistorySyncController extends Controller
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
     * @param  \App\Http\Requests\StoreHistory_syncRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHistory_syncRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History_sync  $history_sync
     * @return \Illuminate\Http\Response
     */
    public function show(History_sync $history_sync)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History_sync  $history_sync
     * @return \Illuminate\Http\Response
     */
    public function edit(History_sync $history_sync)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHistory_syncRequest  $request
     * @param  \App\Models\History_sync  $history_sync
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHistory_syncRequest $request, History_sync $history_sync)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History_sync  $history_sync
     * @return \Illuminate\Http\Response
     */
    public function destroy(History_sync $history_sync)
    {
        //
    }
}
