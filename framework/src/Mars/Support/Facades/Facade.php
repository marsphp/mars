<?php

namespace Mars\Support\Facades;

use Psr\Container\ContainerInterface;
use InvalidArgumentException;

abstract class Facade
{
    /**
     * @var ContainerInterface
     */
    protected static $container;

    /**
     * @var array Resolved instances cache.
     */
    protected static $resolved = [];

    /**
     * Set the container instance.
     *
     * @param ContainerInterface $container
     */
    public static function setContainer(ContainerInterface $container): void
    {
        static::$container = $container;
    }

    /**
     * Get the facade instance from the container.
     *
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function getFacadeInstance()
    {
        $accessor = static::getFacadeAccessor();

        if (!$accessor) {
            throw new InvalidArgumentException('Facade accessor has not been defined.');
        }

        // Check if already resolved
        if (isset(static::$resolved[$accessor])) {
            return static::$resolved[$accessor];
        }

        if (!static::$container->has($accessor)) {
            throw new InvalidArgumentException("The accessor '{$accessor}' is not available in the container.");
        }

        // Resolve the instance and cache it
        return static::$resolved[$accessor] = static::$container->get($accessor);
    }

    /**
     * Handle dynamic, static calls to the facade.
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeInstance();

        if (!method_exists($instance, $method)) {
            throw new \BadMethodCallException("Method {$method} does not exist on the facade instance.");
        }

        return $instance->$method(...$args);
    }

    /**
     * Get the accessor name for the facade.
     *
     * @return string
     */
    abstract protected static function getFacadeAccessor(): string;
}
