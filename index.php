<?php

require 'vendor/autoload.php';

use App\Controllers\HomeController;
use Mars\Core\Core;

//use Dotenv\Dotenv;

//$dotenv =Dotenv::createImmutable(__DIR__);
//$dotenv->load();

$app = new Core;
$container = $app->getContainer();

$container['config'] = function () {
    return [
        'default' => 'mysql',
    ];
};

$container['errorHandler'] = function () {
    return function ($response) {
        return $response->setBody('Page not found')->withStatus(404);
    };
};


$app->get('/', [HomeController::class, 'index']);

$app->run();