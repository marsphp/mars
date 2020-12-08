<?php
require 'vendor/autoload.php';

//use Dotenv\Dotenv;

//$dotenv =Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$core = new Core\Core;
$container = $core->getContainer();

$container['config'] = function () {
    return [
        'default' => 'mysql',
    ];
};

$core->get('/', function () {
    echo 'Home';
});

$core->coreApi('/users', function () {
    echo 'Users';
});

$core->run();