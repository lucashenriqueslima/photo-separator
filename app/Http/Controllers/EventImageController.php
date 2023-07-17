<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventImageRequest;
use App\Http\Requests\UpdateEventImageRequest;
use App\Models\EventImage;
use App\Services\S3Service;

class EventImageController extends Controller
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
    public function store(StoreEventImageRequest $request, EventImage $eventImage, S3Service $s3Service)
    {
        $s3Service->upload($request->file('image'), 'events/' . $request->event_id . '/images');

        $eventImage->create($request->validated());
    }

    /**
     * Display the specified resource.
     */
    public function show(EventImage $eventImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventImageRequest $request, EventImage $eventImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventImage $eventImage)
    {
        //
    }
}
