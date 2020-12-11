<?php

namespace Mars\Core;

interface IBaseResponse
{
    /**
     * @param int $code
     */
    public function setStatusCode(int $code);
}