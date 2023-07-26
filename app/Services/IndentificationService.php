<?php

namespace App\Services;

use App\Helpers\DirHelper;
use App\Models\Event;
use App\Helpers\S3Helper;
use App\Helpers\FileHelper;
use App\Models\Image;

class ImageService
{

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
