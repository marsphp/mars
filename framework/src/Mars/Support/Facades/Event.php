<?php

namespace Mars\Support\Facades;

class Event extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'event';
    }
}