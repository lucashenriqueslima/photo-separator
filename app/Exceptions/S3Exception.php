<?php

namespace App\Exceptions;

use Exception;

class S3Exception extends Exception
{
    protected $awsErrorCode;

    public function __construct($message, $awsErrorCode = null, $code = 0, Exception $previous = null)
    {
        $this->awsErrorCode = $awsErrorCode;
        parent::__construct($message, $code, $previous);
    }

    public function getAwsErrorCode()
    {
        return $this->awsErrorCode;
    }
}
