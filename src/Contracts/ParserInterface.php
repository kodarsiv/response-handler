<?php

namespace Tanerincode\ResponseHandler\Contracts;

use Illuminate\Support\Facades\Response;
use Tanerincode\ResponseHandler\Exceptions\JsonParseException;

interface ParserInterface
{

    /**
     * @throws JsonParseException
     */
    public function parse();

}
