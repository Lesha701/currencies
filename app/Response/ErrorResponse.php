<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;

class ErrorResponse extends JsonResponse
{
    public function __construct(string $errorMessage, int $errorCode)
    {
        parent::__construct([
            'result' => 'error',
            'message' => $errorMessage,
        ], $errorCode);
    }
}
