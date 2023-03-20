<?php

namespace Kodarsiv\ResponseHandler\Contracts;


interface ResponseHandlerInterface
{
    /**
     * @param array $arguments
     * @return array
     */
    public function handle(array $arguments): array;
}
