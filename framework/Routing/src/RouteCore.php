<?php

namespace Mars\Routing;

use Mars\Container\Container;
use Mars\Routing\Exceptions\RouteNotFoundException;

/**
 * Class Core
 * @package Core
 */
class RouteCore {
    /**
     * @var Container
     */
    protected Container $container;

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

    /**
     * GET method route.
     *
     * @param $uri
     * @param $handler
     */
    public function get($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['GET']);
    }

    /**
     * POST method route.
     *
     * @param $uri
     * @param $handler
     */
    public function post($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['POST']);
    }

    /**
     * PUT method route.
     *
     * @param $uri
     * @param $handler
     */
    public function put($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['PUT']);
    }

    /**
     * PATCH method route.
     *
     * @param $uri
     * @param $handler
     */
    public function patch($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['PATCH']);
    }

    /**
     * DELETE method route.
     *
     * @param $uri
     * @param $handler
     */
    public function delete($uri, $handler)
    {
        $this->container->router->addRoute($uri, $handler, ['DELETE']);
    }

    /**
     * array[] methods route.
     * default GET methode is set
     *
     * @param $uri
     * @param $handler
     * @param array|string[] $methods
     */
    public function map($uri, $handler, array $methods = ['GET'])
    {
        $this->container->router->addRoute($uri, $handler, $methods);
    }

    /**
     * @return mixed|void
     */
    public function run()
    {
        $router = $this->container->router;
        $router->setPath($_SERVER['PATH_INFO'] ?? '/');

        try {
            $response = $router->getResponse();
        } catch (RouteNotFoundException $exception) {
            if ($this->container->has('errorHandler')) {
                $response = $this->container->errorHandler;
            } else {
                return;
            }
        }

        return $this->process($response);
    }

    /**
     * @param $callable
     * @return mixed
     */
    protected function process($callable)
    {
        return $callable();
    }
}
