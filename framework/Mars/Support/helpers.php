<?php

use League\Route\Router;
use Mars\Config\Config;
use Mars\Container;

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
     * @param string $abstract
     * @return mixed
     */
    function app(string $abstract): mixed
    {
        return Container::getInstance()->get($abstract);
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

if (!function_exists('base_path')) {
    /**
     * @param string|null $path
     * @return string
     */
    function base_path(?string $path = ''): string {
        return __DIR__ . '/..//' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('public_path')) {
    function public_path(?string $path = ''): string
    {
        return base_path('public') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
