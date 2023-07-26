<?php

namespace App\Http\Controllers;

use App\Helpers\DirHelper;
use App\Helpers\FileHelper;
use App\Helpers\S3Helper;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use App\Services\ImageService;
use App\Services\S3Service;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request, Image $image, string $event)
    {

        $file = FileHelper::base64ToImage($request->image);

        $filePath = DirHelper::getDirNameByEventId($event, $request->name);

        try {
            S3Helper::upload($filePath, $file);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        $image = $image->create(
            [
                'event_id' => $event,
                'name' => $filePath,
                'status' => Image::STATUS_UPLOADED,
            ]
        );

        return response()->json([
            'data' => $image
        ], 201);
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