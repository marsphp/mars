<?php

namespace App;

class App
{
    protected Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}