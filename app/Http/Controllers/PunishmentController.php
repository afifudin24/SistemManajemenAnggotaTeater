<?php

namespace App\Http\Controllers;

use App\Models\Punishment;
use App\Http\Requests\StorePunishmentRequest;
use App\Http\Requests\UpdatePunishmentRequest;

class PunishmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePunishmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Punishment $punishment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Punishment $punishment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePunishmentRequest $request, Punishment $punishment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Punishment $punishment)
    {
        //
    }
}
