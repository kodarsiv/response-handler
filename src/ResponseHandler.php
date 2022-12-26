<?php

namespace Tanerincode\ResponseHandler;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Tanerincode\ResponseHandler\Contracts\ResponseHandlerInterface;

class ResponseHandler implements ResponseHandlerInterface
{

    /**
     * @param array $meta
     * @param array $data
     * @param int $code
     * @return JsonResponse
     */
    public function handle(array $meta, array $data, int $code): JsonResponse
    {
        return Response::json();
    }
}