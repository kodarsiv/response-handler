<?php

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\ResponseHandler;

if (!function_exists('resolve_response')) {
    function resolve_response(...$arguments): JsonResponse {

        $handler = new ResponseHandler();
        $handler->setNewVersionResponse(true);

        if ( isset($arguments['code']) ){
            $meta['code'] = $arguments['code'];
        }

        $result = $handler->handle([
            "meta" => $meta ?? [],
            "data" => $data ?? []
        ]);

        return response()->json($result);
    }
}
if (!function_exists('catch_type_by_code')) {
    function catch_type_by_code(int $errorCode): string {
        $handler = new ResponseHandler();
        $catchResponseType = (int)substr($errorCode, 0, 3);

        return match ($catchResponseType) {
            config('rh.ERRORS_START_AS') => $handler->getErrorCodeParser()->catchTypeByErrorCode($errorCode),
            config('rh.SUCCESS_START_AS') => $handler->getErrorCodeParser()->catchTypeByErrorCode($errorCode)
        };
    }
}


