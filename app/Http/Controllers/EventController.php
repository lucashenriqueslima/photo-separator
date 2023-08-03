<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventIndexResource;
use App\Http\Resources\EventShowResource;
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
            'region' => 'us-east-1', // Defina a região da AWS onde seu recurso Rekognition está configurado
            'version' => 'latest',
            'credentials' => [
                'key' => 'YOUR_AWS_ACCESS_KEY', // Substitua pelas suas credenciais da AWS
                'secret' => 'YOUR_AWS_SECRET_KEY',
            ],
        ]);

        $images = $event->with('images');

        // dd($event->indentifications->toArray());

        $event->indentifications->each(function ($indentification) use ($client, $event) {
            
            $indentificationImage =  [
                'S3Object' => [
                    'Bucket' => env('AWS_BUCKET'),
                    'Name' => $indentification->name,
                ],
            ];

            $result = $client->indexFaces([
                'CollectionId' => (string) $event->id,
                'Image' => $indentificationImage,
                'ExternalImageId' => basename($indentification->name),
            ]);
        });

        $images->each(function ($image) use ($client, $event) {
            
            $image =  [
                'S3Object' => [
                    'Bucket' => 'your-s3-bucket-name',
                    'Name' => $image->name,
                ],
            ];

            $result = $client->searchFacesByImage([
                'CollectionId' => $event->id,
                'Image' => $image,
                'FaceMatchThreshold' => 80,
            ]);

            dd($result);
        });

    }
}
