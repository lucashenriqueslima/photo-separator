<?php

namespace App\Services;

use App\Helpers\DirHelper;
use App\Models\Event;
use App\Helpers\S3Helper;
use App\Helpers\FileHelper;
use App\Models\Image;

class ImageService
{

    public function getDirName($image): string
    {

        $clientPath = "{auth()->user()->client_id}-{auth()->user()->client->name}";
        $eventPath = "{$image->event->id}-{$image->event->name}";
        $imagePath = $image->name;

        return DirHelper::formatDirName("{$clientPath}/{$eventPath}/imagens/{$imagePath}");
    }

    public function getDirNameByEventId($eventId, $imageName): string
    {
        $clientPath = DirHelper::formatDirName(auth()->user()->client_id . '-' . auth()->user()->client->name);
        $eventPath = DirHelper::formatDirName($eventId . '-' . Event::find($eventId)->title);
        $imagePath = $imageName;

        return "{$clientPath}/{$eventPath}/imagens/{$imagePath}";
    }

    //TODO: Implementar o método uploadFile
    public function uploadFile($request)
    {
        $file = FileHelper::base64ToImage($request->image);

        try {
            S3Helper::upload("teste/{$request->name}", $file);
        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
