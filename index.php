<?php

require 'vendor/autoload.php';

use Mars\Routing\RouteCore;

//use Dotenv\Dotenv;

//$dotenv =Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$core = new RouteCore;
$container = $core->getContainer();

$container['config'] = function () {
    return [
        'default' => 'mysql',
    ];
};

$container['errorHandler'] = function () {
    die('404');
};

$core->map('/', function () {
    echo 'Home';
}, ['GET','DELETE']);

$core->run();