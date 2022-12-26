<?php

namespace Tanerincode\ResponseHandler\Contracts;

use Illuminate\Http\JsonResponse;

interface CodesInterface
{

    /**
     * @param ...$arguments
     * @return void
     **/
    public function prepare(...$arguments):void;

    /**
     *
     *
     **/
    public function progress():void;

    /**
     *
     *
     **/
    public function finalize():JsonResponse;

}