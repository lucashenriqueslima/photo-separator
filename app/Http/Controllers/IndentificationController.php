<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndentificationRequest;
use App\Http\Requests\UpdateIndentificationRequest;
use App\Models\Indentification;

class IndentificationController extends Controller
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
    public function store(StoreIndentificationRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(Indentification $indentification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIndentificationRequest $request, Indentification $indentification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indentification $indentification)
    {
        //
    }
}
