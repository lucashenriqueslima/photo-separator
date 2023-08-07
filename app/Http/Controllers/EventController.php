<?php

namespace App\Http\Controllers;

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

        $client->createCollection([
            'CollectionId' => (string) $event->id,
        ]);



        $event->indentifications->each(function ($indentification) use ($client, $event) {

            $indentificationImageS3 =  [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name' => $indentification->name,
                ],
            ];

            $result = $client->indexFaces([
                'CollectionId' => (string) $event->id,
                'Image' => $indentificationImageS3,
                'ExternalImageId' => (string) $indentification->id,
            ]);
        });

        $faceMatches = [];

        $event->images->each(function ($image) use ($client, $event) {

            $imageFaces = $client->detectFaces([
                'Image' => [
                    'S3Object' => [
                        'Bucket' => env('AWS_BUCKET'),
                        'Name' => $image->name,
                    ],
                ],
            ]);

            
            foreach($imageFaces['FaceDetails'] as $faceDetail) {
                $faceMatches[] = $client->searchFaces([
                    'CollectionId' => (string) $event->id,
                    'FaceId' => $faceDetail['FaceId'],
                    'FaceMatchThreshold' => 80,
                ]);
            }

            $result = $client->searchFacesByImage([
                'CollectionId' => (string) $event->id,
                'Image' => $imageS3,
                'FaceMatchThreshold' => 80,
            ]);

            

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
