<?php

namespace App\Interface\Http\Controllers;

use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Mars\Support\Facades\Str;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __invoke(ServerRequestInterface $request)
    {
        $response = new Response();

        $response->getBody()->write(Str::upper('hello'));

        return $response;
    }
}