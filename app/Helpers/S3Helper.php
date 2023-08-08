<?php

namespace App\Helpers;

use App\Exceptions\S3Exception;
use Illuminate\Support\Facades\Storage;

class S3Helper
{

    public static function get(string $path): string
    {
        return Storage::disk('s3')->get($path);
    }

    public static function getCloudObject(string $path): array
    {
        return [
            'S3Object' => [
                'Bucket' => env('AWS_BUCKET'),
                'Name' => $path,
            ],
        ];
    }

    public static function put(string $path, string $file): void
    {
        $result = Storage::disk('s3')->put($path, $file, 'public');

        if (!$result) {
            throw new \Exception('Erro ao fazer upload de arquivo.');
        }
    }





    public function makeDirectory($path)
    {
        try {
            Storage::disk('s3')->makeDirectory($path);
        } catch (S3Exception $e) {
            throw new \App\Exceptions\S3Exception($e->getMessage());
        }
    }
}
