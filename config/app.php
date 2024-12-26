<?php

use Mars\Providers\AppServiceProvider;
use Mars\Providers\RequestServiceProvider;
use Mars\Providers\RouteServiceProvider;

return [
    'name' => env('APP_NAME', 'Mars Framework'),

    'debug' => env('APP_DEBUG', false),

    'providers' => [
        AppServiceProvider::class,
        RequestServiceProvider::class,
        RouteServiceProvider::class,
    ]
];