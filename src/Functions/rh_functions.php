<?php

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\Exceptions\CodeAlreadyExistException;
use Tanerincode\ResponseHandler\ResponseHandler;
use Tanerincode\ResponseHandler\Facades\Responder;
use Tanerincode\ResponseHandler\Classes\CodeGenerator;
use Illuminate\Support\Facades\Log;


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
        return Responder::getErrorCodeParser()->catchTypeByCode($code);
    }
}

if ( !function_exists("find_or_create_code") ) {
    /**
     * @throws CodeAlreadyExistException
     */
    function find_or_create_code(string $key, int $value): int|array
    {
        if ( Responder::getErrorCodeParser()->validateCode($value) ){

            if ( catch_type_by_code($value) != $key ){
                Log::warning("Response code exist but type is different");
            }

            return [
                "type" => catch_type_by_code($value),
                Responder::CODE_STRINGIFY => $value
            ];
        }

        $generator = new CodeGenerator();
        return $generator->generate($key, $value);
    }
}

