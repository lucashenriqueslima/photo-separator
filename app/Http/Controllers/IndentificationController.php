<?php

namespace App\Http\Controllers;

use App\Helpers\DirHelper;
use App\Helpers\FileHelper;
use App\Helpers\S3Helper;
use App\Http\Requests\StoreIndentificationRequest;
use App\Http\Requests\UpdateIndentificationRequest;
use App\Models\Indentification;

class IndentificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Indentification $indentification, string $event)
    {
        return response()->json([
            'data' => $indentification->where('event_id', $event)->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIndentificationRequest $request, Indentification $indentification, string $event)
    {

        $file = FileHelper::base64ToImage($request->image);

        $filePath = DirHelper::getDirNameByEventId($event, $request->name, "identificacoes");

        try {
            S3Helper::upload($filePath, $file);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }

        $indentification = $indentification->create(
            [
                'event_id' => $event,
                'name' => $filePath,
                'status' => "Carregado",
            ]
        );

        return response()->json([
            'data' => $indentification
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Indentification $indentification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIndentificationRequest $request, Indentification $indentification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Indentification $indentification)
    {
        //
    }
}
