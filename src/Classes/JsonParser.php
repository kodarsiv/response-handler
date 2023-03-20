<?php

namespace Kodarsiv\ResponseHandler\Classes;

use Illuminate\Support\Facades\File;
use Kodarsiv\ResponseHandler\Exceptions\JsonParseException;

class JsonParser extends Parser
{

    public function __construct()
    {

        $errorFile = config("rh.code_storage.json.storage_path.error");
        $successFile = config("rh.code_storage.json.storage_path.success");

        if ( !File::exists($errorFile) ){
            File::put($errorFile, json_encode(["default_type" => 5000001]));
        }
        if ( !File::exists($successFile) ){
            File::put($successFile, json_encode(["default_type" => 2000001]));
        }

        $this->setErrorFile($errorFile);
        $this->setSuccessFile($successFile);
    }

    /**
     * @throws JsonParseException
     */
    public function parse(): JsonParser
    {
        parent::parse();

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

}
