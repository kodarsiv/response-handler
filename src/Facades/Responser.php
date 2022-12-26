<?php

namespace Tanerincode\ResponseHandler\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @todo:: update descriptions
 * */
class Responser extends Facade
{

    /**
     * non-readable response flag :
     * if you see this log or response flag on your response this meaning is handle cannot resolve your response.
     **/
    public const UNRESOLVED_FLAG = 'unresolved';

    /**
     * response params are missing :
     * if you see this flag in your response or logs, it means: the parser was unable to read your [meta] object or array.
     **/
    public const UNRESOLVED_TYPE = 'unresolved_response';

    /**
     * Incorrect response flag :
     * when you need to return incorrect response on your response, you need to set your response object `flag` key equal
     * this parameter.
     **/
    public const FLAG_IS_ERROR = 'error';

    /**
     * Correct response flag :
     * when you need to return correct response on your response, you need to set your response object `flag` key equal
     * this parameter.
     **/
    public const FLAG_IS_SUCCESS = 'success';
    public const FLAG_STRINGIFY = 'flag';
    public const CODE_STRINGIFY = 'code';
    public const META_STRINGIFY = 'meta';
    public const DATA_STRINGIFY = 'data';

    protected static function getFacadeAccessor(): string
    {
        return "Responser";
    }
}