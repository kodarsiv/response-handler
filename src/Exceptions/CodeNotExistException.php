<?php

namespace Kodarsiv\ResponseHandler\Exceptions;

use Exception;
use Throwable;

class CodeNotExistException extends ParserException
{
    /**
     *
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Response code not in the storage! run : `rh:generate -{type} -{code}`", $code, $previous);
    }
}
