<?php

namespace Tanerincode\ResponseHandler\Exceptions;

use Exception;
use Throwable;

class CannotConnectedRedisException extends Exception
{
    /**
     *
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}