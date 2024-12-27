<?php

use League\Route\Router;
use Mars\Config\Config;
use Mars\Container\ApplicationContainer;

if (!function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     *
     * @param object|string $class
     * @return string
     */
    function class_basename(object|string $class): string
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (!function_exists('app')) {
    /**
     * @param string|null $abstract
     * @return mixed
     */
    function app(string $abstract = null): mixed
    {
        if (is_null($abstract)) {
            return ApplicationContainer::getInstance();
        }

        return ApplicationContainer::getInstance()->get($abstract);
    }
}

if (!function_exists('config')) {
    /**
     * @param string $key
     * @param $default
     * @return mixed
     */
    function config(string $key, $default = null): mixed
    {
        return app(Config::class)->get($key, $default);
    }
}

if (!function_exists('route')) {
    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    function route(string $name, array $arguments = []): mixed
    {
        return app(Router::class)->getNamedRoute($name)->getPath($arguments);
    }
}

if (! function_exists('base_path')) {
    /**
     * Get the path to the base of the install.
     *
     * @param string $path
     * @return string
     */
    function base_path(string $path = ''): string
    {
        return app()->basePath($path);
    }
}

if (! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    function config_path(string $path = ''): string
    {
        return app()->configPath($path);
    }
}

if (! function_exists('database_path')) {
    /**
     * Get the database path.
     *
     * @param string $path
     * @return string
     */
    function database_path(string $path = ''): string
    {
        return app()->databasePath($path);
    }
}

if (! function_exists('lang_path')) {
    /**
     * Get the path to the language folder.
     *
     * @param string $path
     * @return string
     */
    function lang_path(string $path = ''): string
    {
        return app()->langPath($path);
    }
}

if (! function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param string $path
     * @return string
     */
    function public_path(string $path = ''): string
    {
        return app()->publicPath($path);
    }
}