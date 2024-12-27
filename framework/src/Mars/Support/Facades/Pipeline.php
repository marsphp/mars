<?php

namespace Mars\Support\Facades;

class Pipeline extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'pipeline';
    }
}