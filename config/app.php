<?php

return [
    'name' => env('APP_NAME', 'Mars Framework'),

    'debug' => env('APP_DEBUG', false),

    'providers' => [
        \Mars\Mars\Providers\AppServiceProvider::class,
        \Mars\Mars\Providers\RequestServiceProvider::class,
        \Mars\Mars\Providers\RouteServiceProvider::class,
    ]
];