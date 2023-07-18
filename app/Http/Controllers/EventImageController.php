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

        $uploadedFile = $request->file('image');

        if (!$uploadedFile->isValid()) {
            return response()->json([
                'message' => 'Arquivo inválido.'
            ], 400);
        }

        try {
            $s3Service->upload($uploadedFile, 'event-images');
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

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
