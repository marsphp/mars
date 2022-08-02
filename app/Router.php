<?php

namespace App;

use App\Exceptions\MethodNotAllowedException;
use App\Exceptions\RouteNotFoundException;

class Router
{
    protected string $path;

    protected array $routes = [];

    protected array $methods = [];

    public function setPath(string $path = '/'): void
    {
        $this->path = $path;
    }

    public function addRoute($uri, $handler, array $methods = ['GET'])
    {
        $this->routes[$uri] = $handler;
        $this->methods[$uri] = $methods;
    }

    /**
     * @throws MethodNotAllowedException|RouteNotFoundException
     */
    public function getResponse()
    {
        if (!isset($this->routes[$this->path])) {
            throw new RouteNotFoundException('No route for this '.$this->path);
        }

        if (!in_array($_SERVER['REQUEST_METHOD'], $this->methods[$this->path])) {
            throw new MethodNotAllowedException;
        }

        return $this->routes[$this->path];
    }
}