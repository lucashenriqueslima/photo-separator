<?php

namespace App\Helpers;

use Aws\Rekognition\RekognitionClient;

class RekoginitionHelper {
    
    public $client;

    public function __construct()
    {
        $this->client = new RekognitionClient([
            'region' => 'us-east-1', 
            'version' => 'latest',
        ]);
    }

    public function createCollection(string $collectionId)
    {
        $result = $this->client->createCollection([
            'CollectionId' => $collectionId,
        ]);

        return $result;
    }
}