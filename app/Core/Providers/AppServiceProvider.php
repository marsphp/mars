<?php

namespace Mars\Framework\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mars\Framework\Config\Config;
use Spatie\Ignition\Ignition;

class AppServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function boot(): void
    {
        if ($this->getContainer()->get(Config::class)->get('app.debug')) {
            Ignition::make()->register();
        }
    }

    public function register(): void
    {
      //
    }

    public function provides(string $id): bool
    {
        $services = [];

        return in_array($id, $services);
    }
}