<?php

namespace Core;

use Core\Exceptions\RouteNotFoundException;

/**
 * Class Core
 * @package Core
 */
class Core {
    /**
     * @var Container
     */
    protected $container;

    /**
     * Core constructor.
     */
    public function __construct()
    {
        $this->container = new Container([
            'router' => function() {
                return new Router;
            }
        ]);
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    public function get($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['GET']);
    }

    public function post($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['POST']);
    }

    public function coreApi($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['GET','POST','PUT','PATCH','DELETE']);
    }

    public function run()
    {
        $router = $this->container->router;
        $router->setPath($_SERVER['PATH_INFO'] ?? '/');

        try {
            $response = $router->getResponse();
        } catch (RouteNotFoundException $exception) {
            die('Route not found');
        }

        return $this->process($response);
    }

    protected function process($callable)
    {
        return $callable();
    }
}
