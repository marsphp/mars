<?php

namespace Mars\Container;

use League\Container\Container as LeagueContainer;

class Container
{
    /**
     * @var LeagueContainer
     */
    private static LeagueContainer $container;

    /**
     * Container constructor.
     */
    public function __construct()
    {
        self::$container = new LeagueContainer();
    }

    /**
     * Register provider.
     *
     * @param $provider
     */
    public function registerProvider($provider)
    {
        self::$container->addServiceProvider(new $provider);
    }

    /**
     * @param string $id
     * @return array|mixed|object
     */
    public function get(string $id)
    {
        return self::$container->get($id);
    }
}
