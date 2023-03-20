<?php

namespace Kodarsiv\ResponseHandler\Classes;

use Kodarsiv\ResponseHandler\Contracts\ParserInterface;
use Kodarsiv\ResponseHandler\Exceptions\JsonParseException;

class RedisParser implements ParserInterface
{

    private array $errors;
    private array $success;

    /**
     * @throws JsonParseException
     */
    public function parse(): JsonParser
    {
        try {
            // connect redis..
        }catch (\Exception $exception) {
            throw new JsonParseException($exception->getMessage());
        }

        return $this;
    }


    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     * @return JsonParser
     */
    public function setErrors(array $errors): JsonParser
    {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @return array
     */
    public function getSuccess(): array
    {
        return $this->success;
    }

    /**
     * @param array $success
     * @return JsonParser
     */
    public function setSuccess(array $success): JsonParser
    {
        $this->success = $success;
        return $this;
    }

}
