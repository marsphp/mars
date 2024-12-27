<?php

namespace Mars\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class FacadeServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{

    public function boot(): void
    {
        \Mars\Support\Facades\Str::setContainer($this->container);
    }

    public function register(): void
    {
       $this->getContainer()->addShared('str', function () {
           return new \Mars\Support\Str();
       });
    }

    public function provides(string $id): bool
    {
        $services = [
            'str',
        ];

        return in_array($id, $services);
    }
}