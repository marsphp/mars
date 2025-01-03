<?php

use Dotenv\Dotenv;
use League\Container\ReflectionContainer;
use Mars\App;
use Mars\Config\Config;
use Mars\Container\ApplicationContainer;
use Mars\Providers\ConfigServiceProvider;

error_reporting(0);

require_once __DIR__ . '/../vendor/autoload.php';

$container =  ApplicationContainer::configure(basePath: dirname(__DIR__));

$dotenv = Dotenv::createImmutable(base_path());
$dotenv->load();

$container->delegate(new ReflectionContainer());
$container->addServiceProvider(new ConfigServiceProvider());

$config = $container->get(Config::class);

foreach ($config->get('app.providers') as $provider) {
    $container->addServiceProvider(new $provider);
}

$app = new App($container);

(require('../src/Interface/Routes/api.php'))($app->getRouter(), $container);

$app->run();