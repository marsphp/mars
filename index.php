<?php

require_once __DIR__. '/vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();

$container['config'] = function () {
    return [
        'db_driver' => 'mysql',
        'db_host' => 'localhost',
        'db_name' => 'mars',
        'db_user' => 'root',
        'db_password' => 'root',
    ];
};

$container['db'] = function () {
    return new \PDO('');
};

var_dump($container->config);