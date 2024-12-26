<?php

return [
    'name' => env('APP_NAME', 'Mars Framework'),

    'debug' => env('APP_DEBUG', false),

    'providers' => [
        \Mars\Framework\Providers\AppServiceProvider::class,
        \Mars\Framework\Providers\RequestServiceProvider::class,
        \Mars\Framework\Providers\RouteServiceProvider::class,
    ]
];