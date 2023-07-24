<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use App\Helpers\S3Helper;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
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
    public function store(StoreImageRequest $request, string $event, Image $image)
    {

        $file = FileHelper::base64ToImage($request->image);

        try {
            S3Helper::upload("teste/{$request->name}", $file);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        $image->create(
            [
                'event_id' => $event,
                'name' => $request->name,
            ]
        );

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
