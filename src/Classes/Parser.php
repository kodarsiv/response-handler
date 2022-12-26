<?php

namespace Tanerincode\ResponseHandler\Classes;

use Tanerincode\ResponseHandler\Contracts\ParserInterface;

class Parser implements ParserInterface
{
    private string $errorFile = "";
    private string $successFile = "";
    private array $errors;
    private array $success;
    const UNDEFINED_ERROR_STRINGIFY = "undefined_error_code";

    public function parse()
    {
        // TODO: Implement parse() method.
    }


    public function validateCode(int $code): bool
    {
        $catchResponseType = (int)substr($code, 0, 3);
        $stack =  match ($catchResponseType) {
            config('rh.ERRORS_START_AS') => $this->getErrors(),
            config('rh.SUCCESS_START_AS') => $this->getSuccess()
        };

        if ( in_array($code, array_values($stack)) ){
            return true;
        }

        return false;
    }


    public function catchTypeByCode(int $code = null): string|null
    {
        $catchResponseType = (int)substr($code, 0, 3);
        $stack =  match ($catchResponseType) {
            config('rh.ERRORS_START_AS') => $this->getErrors(),
            config('rh.SUCCESS_START_AS') => $this->getSuccess()
        };

        if ( is_null($code) ) {
            return self::UNDEFINED_ERROR_STRINGIFY;
        }

        if ( in_array($code, $stack) ){
            $key = array_search($code, $stack);
            return ( $key ) ? $key : self::UNDEFINED_ERROR_STRINGIFY;
        }

        return self::UNDEFINED_ERROR_STRINGIFY;
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
     * @return Parser
     */
    public function setErrors(array $errors): Parser
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
     * @return Parser
     */
    public function setSuccess(array $success): Parser
    {
        $this->success = $success;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorFile(): string
    {
        return $this->errorFile;
    }

    /**
     * @param mixed $errorFile
     * @return Parser
     */
    public function setErrorFile(string $errorFile): Parser
    {
        $this->errorFile = $errorFile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuccessFile(): string
    {
        return $this->successFile;
    }

    /**
     * @param string $successFile
     * @return Parser
     */
    public function setSuccessFile(string $successFile): Parser
    {
        $this->successFile = $successFile;
        return $this;
    }
}
