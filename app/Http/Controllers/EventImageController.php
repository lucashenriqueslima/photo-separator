<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use App\Services\S3Service;

class ImageController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request, Image $image, S3Service $s3Service)
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

        $image->create($requestBody);

        return response()->json(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        //
    }
}
