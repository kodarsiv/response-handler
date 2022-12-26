<?php

namespace Tanerincode\ResponseHandler;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Tanerincode\ResponseHandler\Classes\JsonParser;
use Tanerincode\ResponseHandler\Classes\RedisParser;
use Tanerincode\ResponseHandler\Contracts\ParserInterface;
use Tanerincode\ResponseHandler\Contracts\ResponseHandlerInterface;
use Tanerincode\ResponseHandler\Exceptions\ParserException;
use Tanerincode\ResponseHandler\Facades\Responder;

class ResponseHandler implements ResponseHandlerInterface
{
    private ParserInterface $errorCodeParser;
    public array $response;
    public bool $newVersionResponse;

    public function __construct() {
        $this->setErrorCodeParser($this->errorCodesParser());
        $this->setNewVersionResponse(false);
    }

    /**
     * @param array $arguments
     * @return array
     */
    public function handle(array $arguments): array
    {
        $this->handleMeta($arguments[Responder::META_STRINGIFY] ?? []);

        if ( !isset($arguments[Responder::DATA_STRINGIFY]) ){
            $this->response[Responder::DATA_STRINGIFY] = [];
        }else {
            $this->response[Responder::DATA_STRINGIFY] = $arguments[Responder::DATA_STRINGIFY];
        }

        if ( $this->isNewVersionResponse() )
            $this->clearResponse();

        return $this->response;
    }

    private function handleMeta(array $meta = [])
    {
        $this->response[Responder::META_STRINGIFY] = [
            Responder::FLAG_STRINGIFY => $meta[Responder::FLAG_STRINGIFY] ?? Responder::FLAG_IS_ERROR,
            Responder::CODE_STRINGIFY => $meta[Responder::CODE_STRINGIFY],
            "type" => catch_type_by_code($meta[Responder::CODE_STRINGIFY])
        ];
    }

    private function clearResponse()
    {
        $responseTMP = [];
        foreach ($this->response[Responder::META_STRINGIFY] as $key => $response) {
            $responseTMP[$key] = $response;
        }
        $responseTMP["data"] = $this->response['data'];

        $this->response = $responseTMP;
    }


    public function errorCodesParser(): JsonParser|RedisParser
    {


        // we need to catch parser by config storage.
        $parser = match (config("rh.STORAGE")) {
            'redis' => new RedisParser(),
            default => new JsonParser(),
        };

        try {
            $parser->parse();

        }catch (ParserException $exception){
            Log::error($exception->getMessage());
        }

        return $parser;

    }

    /**
     * @return ParserInterface
     */
    public function getErrorCodeParser(): ParserInterface
    {
        return $this->errorCodeParser;
    }

    /**
     * @param ParserInterface $errorCodeParser
     * @return ResponseHandler
     */
    public function setErrorCodeParser(ParserInterface $errorCodeParser): ResponseHandler
    {
        $this->errorCodeParser = $errorCodeParser;
        return $this;
    }

    /**
     * @param array $response
     * @return self
     */
    public function setResponse(array $response): self
    {
        $this->response = $response;
        return $this;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * @return bool
     */
    public function isNewVersionResponse(): bool
    {
        return $this->newVersionResponse;
    }

    /**
     * @param bool $newVersionResponse
     * @return self
     */
    public function setNewVersionResponse(bool $newVersionResponse): self
    {
        $this->newVersionResponse = $newVersionResponse;
        return $this;
    }


}
