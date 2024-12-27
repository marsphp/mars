<?php

namespace Mars\Support\Facades;

class Date extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'date';
    }
}