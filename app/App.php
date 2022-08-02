<?php

namespace App;

class App
{
    protected $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @return mixed
     */
    public function getContainer(): mixed
    {
        return $this->container;
    }


}