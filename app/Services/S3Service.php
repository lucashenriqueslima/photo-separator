<?php

namespace App\Services;

use App\Exceptions\S3Exception;
use Illuminate\Support\Facades\Storage;

class S3Service
{

    public function upload($file, $path)
    {
        $result = Storage::disk('s3')->put($path, $file, 'public');

        if (!$result) {
            throw new \Exception('Erro ao fazer upload de arquivo.');
        }

        return $result;
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
