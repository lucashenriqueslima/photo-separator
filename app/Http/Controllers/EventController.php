<?php

namespace App\Http\Controllers;

use App\Helpers\S3Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\EventIndexResource;
use App\Http\Resources\EventShowResource;
use App\Models\ComparisonCombination;
use App\Models\Event;
use App\Services\EventService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Support\Facades\Storage;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Event $event)
    {
        return EventIndexResource::collection(
            Event::with('eventStatus')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::with('eventStatus')
            ->findOrFail($id);

        return EventShowResource::make($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function compareFaces(Request $request, EventService $service, string $id)
    {


        $event = Event::with('indentifications', 'images')->findOrFail($id);

        $client = new RekognitionClient([
            'region' => 'us-east-1', 
            'version' => 'latest',
        ]);

        // $client->createCollection([
        //     'CollectionId' => (string) $event->id,
        // ]);



        $event->indentifications->each(function ($indentification) use ($client, $event) {


            $result = $client->indexFaces([
                'CollectionId' => (string) $event->id,
                'Image' => S3Helper::getCloudObject($indentification->name),
                'ExternalImageId' => (string) $indentification->id,
            ]);
        });

        $faceMatches = [];

        $event->images->each(function ($image) use ($client, $event) {

            $imageData = S3Helper::get($image->name);

            // dd('die');            

            $detectedFaces = $client->detectFaces([
            'Image' => [
                    'Bytes' => $imageData,
                ],
            ]);

            dd($detectedFaces['FaceDetails']);

            
            $imageCloudObject = S3Helper::getCloudObject($image->name);

            
            foreach($detectedFaces['FaceDetails'] as $detectedFace) {

                dd($detectedFace);

                $boundingBox = $detectedFace['BoundingBox'];
                $left = intval($boundingBox['Left'] * $detectedFace['ImageWidth']);
                $top = intval($boundingBox['Top'] * $detectedFace['ImageHeight']);
                $width = intval($boundingBox['Width'] * $detectedFace['ImageWidth']);
                $height = intval($boundingBox['Height'] * $detectedFace['ImageHeight']);

                // Extrair a imagem do rosto
                $faceImage = imagecrop(imagecreatefromstring($imageData), [
                    'x' => $left,
                    'y' => $top,
                    'width' => $width,
                    'height' => $height,
                ]);

                // Salvar a imagem do rosto temporariamente
                $tempImagePath = 'temp_face_image.jpg';
                
                Storage::disk('local')->put($tempImagePath, $faceImage);

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

            // $result = $client->searchFacesByImage([
            //     'CollectionId' => (string) $event->id,
            //     'Image' => $imageCloudObject,
            //     'FaceMatchThreshold' => 80,
            // ]);

            

            // $faceMatches = $result['FaceMatches'];

            // $faceMatches->each(function ($faceMatch) use ($image) {
            //     ComparisonCombination::create([
            //         'indentification_id' => $faceMatch['Face']['ExternalImageId'],
            //         'image_id' => $image->id,
            //         'similarity' => $faceMatch['Similarity'],
            //     ]);
            // });
            
        });

        dd($faceMatches);

    }
}
