<?php

use Dotenv\Dotenv;
use Laminas\Diactoros\Response;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use League\Container\ReflectionContainer;
use Mars\Framework\App;
use Mars\Framework\Config\Config;
use Mars\Framework\Container;
use Mars\Framework\Providers\ConfigServiceProvider;

error_reporting(0);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container =  Container::getInstance();

$container->delegate(new ReflectionContainer());

$container->addServiceProvider(new ConfigServiceProvider());

$config = $container->get(Config::class);

foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}

$app = new App($container);

$router = $container->get(\League\Route\Router::class);

$app->getRouter()->get('/', function () {
    $res = new Response();

    $res->getBody()->write('Hello World!');

    return $res;
});

$app->run();