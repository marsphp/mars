<?php

namespace Mars\Core;

interface IBaseRequest
{
    /**
     * @return mixed
     */
    public function getPath(): mixed;

    /**
     * @return string
     */
    public function method(): string;

    /**
     * @return bool
     */
    public function isGet(): bool;

    /**
     * @return bool
     */
    public function isPost(): bool;

    /**
     * @return array
     */
    public function getBody() : array;
}