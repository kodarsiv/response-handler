<?php

namespace Tanerincode\ResponseHandler\Contracts;

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\Classes\JsonParser;

interface ResponseHandlerInterface
{
    /**
     * @param array $meta
     * @param array $data
     * @return array
     */
    public function handle(array $meta, array $data): array;
}
