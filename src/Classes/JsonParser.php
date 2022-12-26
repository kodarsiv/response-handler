<?php

namespace Tanerincode\ResponseHandler\Classes;

use Tanerincode\ResponseHandler\Contracts\ParserInterface;
use Tanerincode\ResponseHandler\Exceptions\JsonParseException;

class JsonParser extends Parser
{

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
