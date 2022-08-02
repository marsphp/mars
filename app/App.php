<?php

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{
    protected Container $container;

    public function __construct()
    {
        $this->container = new Container([
            'router' => function () {
                return new Router();
            }
        ]);
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    public function get($uri, $handler): void
    {
        $this->container->router->addRoute($uri, $handler, ['GET']);
    }

    public function post($uri, $handler): void
    {
        $this->container->router->addRoute($uri, $handler, ['POST']);
    }

    public function map($uri, $handler, $methods): void
    {
        $this->container->router->addRoute($uri, $handler, $methods);
    }

    public function run()
    {
        $router = $this->container->router;
        $router->setPath($_SERVER['PATH_INFO'] ?? '/');

        try {
            $response = $router->getResponse();
        } catch (RouteNotFoundException $e) {
            if ($this->container->has('errorHandler')) {
                $response = $this->container->errorHandler;
            } else {
                return;
            }
        }

        return $this->process($response);
    }

    protected function process(callable $callable)
    {
        if (is_array($callable)) {
            if (is_object($callable[0])) {
                $callable[0] = new $callable[0];
            }

            return call_user_func($callable);
        }
        return $callable();
    }
}