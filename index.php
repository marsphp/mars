<?php

require_once __DIR__. '/vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();

$container['config'] = [
    'db_driver' => 'mysql',
    'db_host' => 'localhost',
    'db_name' => 'mars',
    'db_user' => 'root',
    'db_password' => 'root',
];

var_dump(isset($container['db']));