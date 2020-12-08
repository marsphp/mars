<?php
require 'vendor/autoload.php';

//use Dotenv\Dotenv;

//$dotenv =Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$core = new framework\Core;
$container = $core->getContainer();

$container['config'] = function () {
    return [
        'default' => 'mysql',
    ];
};

$container['errorHandler'] = function () {
    die('404');
};

$core->get('/', function () {
    echo 'Home';
});

$core->coreApi('/users', function () {
    echo 'Users';
});

$core->run();