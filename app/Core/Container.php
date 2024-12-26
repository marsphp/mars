<?php

namespace Mars\Framework;

class Container
{
    protected static $instance;

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new \League\Container\Container();
        }

        return static::$instance;
    }
}