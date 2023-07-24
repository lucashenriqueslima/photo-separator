<?php

namespace App\Helpers;

class FileHelper
{

    public static function base64ToImage(string $base64File): string
    {
        return base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
    }

    public static function deleteImage(string $fileName): void
    {
        $filePath = storage_path('app/public/event-images/' . $fileName);

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
