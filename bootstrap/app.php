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

(require('../src/Interface/Routes/api.php'))($app->getRouter(), $container);

$app->run();