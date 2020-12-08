<?php

require 'vendor/autoload.php';

use Mars\Routing\RouteCore;

//use Dotenv\Dotenv;

//$dotenv =Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$app = new RouteCore;
$container = $app->getContainer();

$container['config'] = function () {
    return [
        'default' => 'mysql',
    ];
};

$container['errorHandler'] = function () {
    die('404');
};

$app->map('/', function () {
    echo 'Home';
}, ['GET','DELETE']);

$app->run();