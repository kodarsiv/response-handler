<?php

namespace Tanerincode\ResponseHandler\Facades;

use Illuminate\Support\Facades\Facade;

class Responser extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "Responser";
    }
}