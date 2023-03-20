<?php

namespace Kodarsiv\ResponseHandler\Exceptions;

use Exception;
use Throwable;

class CodeAlreadyExistException extends ParserException
{
    /**
     *
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Response code already exist! Look your storage!", $code, $previous);
    }
}
