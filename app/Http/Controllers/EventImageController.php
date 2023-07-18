<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventImageRequest;
use App\Http\Requests\UpdateEventImageRequest;
use App\Models\EventImage;
use App\Services\S3Service;

class EventImageController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventImageRequest $request, EventImage $eventImage, S3Service $s3Service)
    {
        $requestBody = $request->validated();

        try {
            $s3Service->upload($request->file('image'), 'event-images');
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        $requestBody->status = EventImage::STATUS_UPLOADED;

        $eventImage->create($requestBody);

        return response()->json(201);
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
