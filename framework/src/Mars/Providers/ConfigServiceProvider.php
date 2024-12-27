<?php

namespace Mars\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Mars\Config\Config;
use Spatie\Ignition\Ignition;

class ConfigServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    public function boot(): void
    {
        // TODO: Implement boot() method.
    }

    public function register(): void
    {
        $this->getContainer()->addShared(Config::class, function () {
            $config = new Config();

            return $this->mergeConfigFromFiles($config);
        });
    }

    public function provides(string $id): bool
    {
        $services = [
            Config::class,
        ];

        return in_array($id, $services);
    }

    protected function mergeConfigFromFiles(Config $config): Config
    {
        $path = __DIR__ . '/../../../../config';

       foreach (array_diff(scandir($path), ['.', '..']) as $file) {
           $config->merge([
               explode('.', $file)[0] => require($path . '/' . $file),
           ]);
       }

      return $config;
    }
}