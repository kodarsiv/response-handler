<?php

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\ResponseHandler;

if (!function_exists('resolve_response')) {
    function resolve_response(...$arguments): array|JsonResponse {

        $handler = new ResponseHandler();
        $result = $handler->handle([], []);

        return response()->json($result);

    }
}
