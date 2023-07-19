<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventIndentificationRequest;
use App\Http\Requests\UpdateEventIndentificationRequest;
use App\Models\EventIndentification;

class EventIndentificationController extends Controller
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
    public function store(StoreEventIndentificationRequest $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(EventIndentification $indentification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventIndentificationRequest $request, EventIndentification $indentification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventIndentification $indentification)
    {
        //
    }
}
