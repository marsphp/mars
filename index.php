<?php

use Mars\Routing\Core;

require 'vendor/autoload.php';

//use Dotenv\Dotenv;

//$dotenv =Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$core = new Core;
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