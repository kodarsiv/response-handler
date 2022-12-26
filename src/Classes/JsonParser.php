<?php

namespace Tanerincode\ResponseHandler\Classes;

use Tanerincode\ResponseHandler\Contracts\ParserInterface;
use Tanerincode\ResponseHandler\Exceptions\JsonParseException;

class JsonParser implements ParserInterface
{
    private string $errorFile;
    private string $successFile;

    private array $errors;
    private array $success;


    public function __construct()
    {
        $this->setErrorFile(config("rh.code_storage.json.storage_path.error"));
        $this->setSuccessFile(config("rh.code_storage.json.storage_path.success"));
    }

    /**
     * @throws JsonParseException
     */
    public function parse(): JsonParser
    {
        try {
            $this->parseForErrors();
            $this->parseForSuccess();
        }catch (\Exception $exception) {
            throw new JsonParseException($exception->getMessage());
        }

        return $this;
    }

    /**
     * @throws JsonParseException
     */
    private function parseForErrors(): void
    {
        $params = json_decode(file_get_contents($this->getErrorFile()), true);
        if ( !$params )
            throw new JsonParseException();

        $this->setErrors($params);
    }

    /**
     * @throws JsonParseException
     */
    private function parseForSuccess(): void
    {
        $params = json_decode(file_get_contents($this->getSuccessFile()), true);
        if ( !$params )
            throw new JsonParseException();

        $this->setSuccess($params);
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

    /**
     * @return mixed
     */
    public function getErrorFile(): string
    {
        return $this->errorFile;
    }

    /**
     * @param mixed $errorFile
     * @return JsonParser
     */
    public function setErrorFile(string $errorFile): JsonParser
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
     * @return JsonParser
     */
    public function setSuccessFile(string $successFile): JsonParser
    {
        $this->successFile = $successFile;
        return $this;
    }

}
