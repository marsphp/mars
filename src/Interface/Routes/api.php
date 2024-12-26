<?php

use App\Interface\Http\Controllers\HomeController;
use League\Route\Router;
use Psr\Container\ContainerInterface;

return static function (Router $router, ContainerInterface $container) {
    $router->get('/', HomeController::class);
};
