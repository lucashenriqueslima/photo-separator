<?php

namespace App\Http\Controllers;

use App\Helpers\DirHelper;
use App\Helpers\FileHelper;
use App\Helpers\S3Helper;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Face;
use App\Models\Image;
use App\Services\ImageService;
use App\Services\S3Service;
use Illuminate\Support\Facades\Storage;
use Aws\Rekognition\RekognitionClient;

class ImageController extends Controller
{

    public function index(Image $image, string $event)
    {
        return response()->json([
            'data' => $image->where('event_id', $event)->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request, Image $image, string $event)
    {

        $file = FileHelper::base64ToImage($request->image);

        $filePath = DirHelper::getDirNameByEventId($event, $request->name);

        $rekoginition = new RekognitionClient([
            'region' => 'us-east-1', 
            'version' => 'latest',
        ]);


        $detectedFaces = $rekoginition->detectFaces([
            'Image' => [
                    'Bytes' => $file,
                ],
        ]);


        if(!$detectedFaces['FaceDetails']) {
            $image = $image->create(
                [
                    'event_id' => $event,
                    'name' => $filePath,
                    'error_message' => 'Nenhuma face detectada.',
                    'status' => Image::STATUS_UPLOAD_ERROR,
                ]
            );

            return response()->json([
                'data' => $image
            ], 201);
        }

        foreach($detectedFaces['FaceDetails'] as $detectedFace) {

            $boundingBox = $detectedFace['BoundingBox'];
            $left = intval($boundingBox['Left'] * $detectedFace['ImageWidth']);
            $top = intval($boundingBox['Top'] * $detectedFace['ImageHeight']);
            $width = intval($boundingBox['Width'] * $detectedFace['ImageWidth']);
            $height = intval($boundingBox['Height'] * $detectedFace['ImageHeight']);

            // Extrair a imagem do rosto
            $faceImage = imagecrop(imagecreatefromstring($file), [
                'x' => $left,
                'y' => $top,
                'width' => $width,
                'height' => $height,
            ]);

            Face::create([
                'image_id' => $image->id,
                'name' => $faceImage,
            ]);
            
            S3Helper::put($, $faceImage);

            // Comparar o rosto com a coleção
            $result = $client->searchFacesByImage([
                'CollectionId' => (string) $event->id,
                'Image' => [
                    'Bytes' => Storage::disk('local')->get($tempImagePath),
                ],
                'FaceMatchThreshold' => 80,
            ]);
            
            Storage::disk('local')->delete($tempImagePath);
            
            dd($result);
        }




        try {
            S3Helper::put($filePath, $file);
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
