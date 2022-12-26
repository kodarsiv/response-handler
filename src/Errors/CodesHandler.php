<?php

namespace Tanerincode\ResponseHandler\Errors;

use Illuminate\Http\JsonResponse;
use Tanerincode\ResponseHandler\Contracts\CodesInterface;

class CodesHandler implements CodesInterface
{

    public function prepare(...$arguments): void
    {
        // TODO: Implement prepare() method.
    }

    public function progress(): void
    {
        // TODO: Implement progress() method.
    }

    public function finalize(): JsonResponse
    {
        // TODO: Implement finalize() method.
    }
}