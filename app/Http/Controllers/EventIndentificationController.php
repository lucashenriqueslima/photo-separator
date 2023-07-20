<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdentificationRequest;
use App\Http\Requests\UpdateIdentificationRequest;
use App\Models\Identification;

class IdentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIdentificationRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Identification $indentification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdentificationRequest $request, Identification $indentification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Identification $indentification)
    {
        //
    }
}
