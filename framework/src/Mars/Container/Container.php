<?php

namespace Mars\Container;

use League\Container\Container as LeagueContainer;

class Container extends LeagueContainer
{
    protected static $instance;

    public static function getInstance(): static
    {
        return static::$instance ??= new static;
    }

    public static function setInstance($container = null)
    {
        return static::$instance = $container;
    }
}
