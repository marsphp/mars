<?php

namespace Core;

use Core\Exceptions\MethodeNotAllowedException;

/**
 * Class Router
 * @package Core
 */
class Router
{
    /**
     * @var mixed|string
     */
    protected $path;

    /**
     * @var array
     */
    protected $routes = [];

    protected $methods = [];

    /**
     * @param string $path
     */
    public function setPath($path = '/')
    {
        $this->path = $path;
    }

    /**
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
     * @return array
     * @throws MethodeNotAllowedException
     */
    public function getResponse()
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], $this->methods[$this->path])) {
            throw new MethodeNotAllowedException;
        }


        return $this->routes[$this->path];
    }
}