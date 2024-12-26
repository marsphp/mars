<?php

use Dotenv\Dotenv;
use Mars\App;
use League\Container\ReflectionContainer;
use Mars\Config\Config;
use Mars\Container;
use Mars\Providers\ConfigServiceProvider;

//error_reporting(0);

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(base_path());
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