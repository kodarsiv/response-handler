<?php

namespace Kodarsiv\ResponseHandler\Contracts;

use Illuminate\Support\Facades\Response;

interface CodeInterface
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
    public function finalize(): Response;

}
