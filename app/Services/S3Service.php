<?php

namespace App\Services;

use App\Exceptions\S3Exception;
use Illuminate\Support\Facades\Storage;

class S3Service
{

    public function upload($file, $path)
    {
        try {
            $path = Storage::disk('s3')->put($path, $file, 'public');
        } catch (S3Exception $e) {
            return response()->json(['error' => 'Erro ao fazer upload do arquivo: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Ocorreu um erro desconhecido: ' . $e->getMessage()], 500);
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
