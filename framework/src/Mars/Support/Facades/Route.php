<?php

namespace Mars\Support\Facades;

class Route extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'route';
    }
}