<?php

namespace Kodarsiv\ResponseHandler\Handlers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Kodarsiv\ResponseHandler\Contracts\CodeInterface;

class ErrorCodes implements CodeInterface
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
        return Response::json();
        // TODO: Implement finalize() method.
    }
}
