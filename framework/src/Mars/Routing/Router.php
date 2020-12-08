<?php

namespace Mars\Routing;

use Mars\Routing\Exceptions\MethodeNotAllowedException;
use Mars\Routing\Exceptions\RouteNotFoundException;

/**
 * Class Router
 * @package Mars
 */
class Router
{
    /**
     * @var mixed|string
     */
    protected $path;

    /**
     * Routes.
     *
     * @var array
     */
    protected array $routes = [];

    /**
     * Methods.
     *
     * @var array
     */
    protected array $methods = [];

    /**
     * @param string $path
     */
    public function setPath($path = '/')
    {
        $this->path = $path;
    }

    /**
     * Add route.
     *
     * @param $uri
     * @param $handler
     * @param array $methods
     */
    public function addRoute($uri, $handler, array $methods = ['GET'])
    {
        $this->routes[$uri] = $handler;
        $this->methods[$uri] = $methods;
    }

    /**
     * Get response.
     *
     * @return mixed
     *
     * @throws MethodeNotAllowedException
     * @throws RouteNotFoundException
     */
    public function getResponse()
    {
        if (!isset($this->routes[$this->path])) {
            throw new RouteNotFoundException('No route registered for '. $this->path);
        }

        if (!in_array($_SERVER['REQUEST_METHOD'], $this->methods[$this->path])) {
            throw new MethodeNotAllowedException;
        }

        return $this->routes[$this->path];
    }
}