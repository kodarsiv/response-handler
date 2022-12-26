<?php

namespace Tanerincode\ResponseHandler\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

interface ResponseHandlerInterface
{
    /**
     * @param array $meta
     * @param array $data
     * @param int $code
     * @return JsonResponse
     */
    public function handle(array $meta, array $data, int $code): JsonResponse;
}