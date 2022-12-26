<?php

namespace Tanerincode\ResponseHandler\Contracts;

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\Classes\JsonParser;

interface ResponseHandlerInterface
{
    /**
     * @param array $arguments
     * @return array
     */
    public function handle(array $arguments): array;
}
