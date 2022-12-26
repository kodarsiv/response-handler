<?php

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\ResponseHandler;
use Tanerincode\ResponseHandler\Facades\Responder;

if (!function_exists('resolve_response')) {
    function resolve_response(...$arguments): JsonResponse {

        $handler = new ResponseHandler();
        $handler->setNewVersionResponse(true);

        if ( isset($arguments[Responder::CODE_STRINGIFY]) ){
            $meta[Responder::CODE_STRINGIFY] = $arguments[Responder::CODE_STRINGIFY];
        }

        $result = $handler->handle([
            Responder::META_STRINGIFY => $meta ?? [],
            Responder::DATA_STRINGIFY => $data ?? []
        ]);

        return response()->json($result);
    }
}
if (!function_exists('catch_type_by_code')) {
    function catch_type_by_code(int $code): string|null {
        return (new ResponseHandler)->getErrorCodeParser()->catchTypeByCode($code);
    }
}


