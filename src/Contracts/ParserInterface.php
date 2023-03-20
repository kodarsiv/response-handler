<?php

namespace Kodarsiv\ResponseHandler\Contracts;

use Illuminate\Support\Facades\Response;
use Kodarsiv\ResponseHandler\Exceptions\JsonParseException;

interface ParserInterface
{

    /**
     * @throws JsonParseException
     */
    public function parse();

}
