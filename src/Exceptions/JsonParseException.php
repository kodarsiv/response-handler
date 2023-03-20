<?php

namespace Kodarsiv\ResponseHandler\Exceptions;

use Exception;
use Throwable;

class JsonParseException extends ParserException
{
    /**
     *
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Json File Cannot readable!", $code, $previous);
    }
}
