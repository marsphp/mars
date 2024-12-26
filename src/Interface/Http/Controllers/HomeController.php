<?php

namespace App\Interface\Http\Controllers;

use Laminas\Diactoros\Request;
use Laminas\Diactoros\Response;
use Psr\Http\Message\ServerRequestInterface;

class HomeController
{
    public function __construct() {}

    public function __invoke(ServerRequestInterface $request)
    {
        $response = new Response();

        $response->getBody()->write($request->getQueryParams()['name']);

        return $response;
    }
}