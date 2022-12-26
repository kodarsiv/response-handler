<?php

namespace Tanerincode\ResponseHandler;

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\Classes\JsonParser;
use Tanerincode\ResponseHandler\Classes\RedisParser;
use Tanerincode\ResponseHandler\Contracts\ResponseHandlerInterface;
use Tanerincode\ResponseHandler\Exceptions\JsonParseException;
use Tanerincode\ResponseHandler\Exceptions\ParserException;

class ResponseHandler implements ResponseHandlerInterface
{

    /**
     * @param array $meta
     * @param array $data
     * @return array
     */
    public function handle(array $meta, array $data): array
    {
        // we need to catch parser by config storage.
        $parser = match (config("rh.STORAGE")) {
            'redis' => new RedisParser(),
            default => new JsonParser(),
        };

        try {
            $parser->parse();

        }catch (ParserException $exception){
            dd($exception->getMessage());
        }


        return [
            "success" => $parser->getSuccess(),
            "errors" => $parser->getErrors()
        ];
    }
}
