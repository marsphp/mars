<?php

namespace App\Interface\Http\Controllers;

class HomeController
{
    public function __invoke()
    {
        var_dump('HomeController');
        die();
    }
}