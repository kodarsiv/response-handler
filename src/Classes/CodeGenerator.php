<?php

namespace Kodarsiv\ResponseHandler\Classes;

use Illuminate\Support\Facades\File;
use Kodarsiv\ResponseHandler\Exceptions\CodeAlreadyExistException;
use Kodarsiv\ResponseHandler\Facades\Responder;

class CodeGenerator
{
    public const TYPE_IS_ERROR = "error";
    public const TYPE_IS_SUCCESS = "success";

    /**
     * @throws CodeAlreadyExistException
     */
    public function generate(string $key, int $value): int
    {
        if (Responder::getErrorCodeParser()->validateCode($value)) {
            throw new CodeAlreadyExistException();
        }

        return $this->make($key, $value);
    }

    private function make(string $key, int $value): int
    {
        if ( config("rh.STORAGE") == "json" )
        {
            return $this->makeForJson($key, $value);
        }

        return $value;
    }

    private function makeForJson(string $key, int $value): int
    {
        $codeStartBy = (int)substr($value, 0, 3);
        $file = match ($codeStartBy){
            config('rh.SUCCESS_START_AS') => Responder::getErrorCodeParser()->getSuccessFile(),
            config('rh.ERRORS_START_AS') => Responder::getErrorCodeParser()->getErrorFile(),
        };

        if ( File::isReadable($file) ) {
            $content = json_decode(file_get_contents($file), true);
            $content = array_merge($content, [$key => $value]);
            $put = File::put($file, json_encode($content));
        }

        return $value;
    }



}
