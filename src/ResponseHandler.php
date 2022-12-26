<?php

namespace Tanerincode\ResponseHandler;

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
        $this->handleMeta($arguments['meta'] ?? []);

        if ( !isset($arguments['data']) ){
            $this->response['data'] = [];
        }else {
            $this->response['data'] = $arguments['data'];
        }

        if ( $this->isNewVersionResponse() )
            $this->clearResponse();

        return $this->response;
    }

    private function handleMeta(array $meta = [])
    {
        $errorCode = $this->getErrorCodeParser()->catchErrorCode($meta['code'] ?? null);

        $this->response['meta'] = [
            "flag" => $meta['flag'] ?? Responder::FLAG_IS_ERROR,
            "code" => $errorCode,
            "type" => catch_type_by_code($errorCode)
        ];
    }

    private function clearResponse()
    {
        $responseTMP = [];
        foreach ($this->response['meta'] as $key => $response) {
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
