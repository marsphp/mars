<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = new App\App;

$container = $app->getContainer();


$container['errorHandler'] = function () {
    //
};

$container['config'] = function () {
    return [
        'db_driver' => 'pgsql',
        'db_host' => 'localhost',
        'db_name' => 'mars_db',
        'db_user' => 'mars_user',
        'db_password' => 'password',
    ];
};

$container['db'] = function ($c) {
    return new \PDO(
        $c->config['db_driver'] . ':host=' . $c->config['db_host'] . ';dbname=' . $c->config['db_name'],
        $c->config['db_user'],
        $c->config['db_password']
    );
};

$app->get('/home', function () {
    echo 'Home';
});

$app->run();