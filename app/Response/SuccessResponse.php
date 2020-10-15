<?php

namespace App\Response;

use Illuminate\Http\JsonResponse;

class SuccessResponse extends JsonResponse
{
    /**
     * SuccessResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct([
            'result' => 'success',
            'data' => $data,
        ]);
    }
}
