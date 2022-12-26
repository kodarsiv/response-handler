<?php

namespace Tanerincode\ResponseHandler\Classes;

use Tanerincode\ResponseHandler\Contracts\ParserInterface;

class Parser implements ParserInterface
{
    private string $errorFile;
    private string $successFile;
    private array $errors;
    private array $success;
    const UNDEFINED_ERROR_STRINGIFY = "undefined_error_code";

    public function __construct()
    {
        $this->setErrorFile(config("rh.code_storage.json.storage_path.error"));
        $this->setSuccessFile(config("rh.code_storage.json.storage_path.success"));
    }

    public function parse()
    {
        // TODO: Implement parse() method.
    }


    public function catchErrorCode(int $code = null): int
    {
        if ( is_null($code) ) {
            return $this->getErrors()['undefined_error_code'] ?? 50001;
        }

        if ( in_array($code, $this->getErrors()) ){
            $key = array_search($code, $this->getErrors());
            return $this->getErrors()[$key];
        }

        return $this->getErrors()['undefined_error_code'] ?? 50001;
    }


    public function catchTypeByErrorCode(int $code = null): string
    {
        if ( is_null($code) ) {
            return self::UNDEFINED_ERROR_STRINGIFY;
        }

        if ( in_array($code, $this->getErrors()) ){
            $key = array_search($code, $this->getErrors());
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
