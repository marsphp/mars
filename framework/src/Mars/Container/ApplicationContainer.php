<?php

namespace Mars\Container;

use function Mars\Filesystem\join_paths;

class ApplicationContainer extends Container
{
    /**
     * The base path for the Mars installation.
     *
     * @var string
     */
    protected string $basePath;

    /**
     * The custom bootstrap path defined by the developer.
     *
     * @var string
     */
    protected string $bootstrapPath;

    /**
     * The custom application path defined by the developer.
     *
     * @var string
     */
    protected string $appPath;

    /**
     * The custom configuration path defined by the developer.
     *
     * @var string
     */
    protected string $configPath;

    /**
     * The custom database path defined by the developer.
     *
     * @var string
     */
    protected string $databasePath;

    /**
     * The custom language file path defined by the developer.
     *
     * @var string
     */
    protected string $langPath;

    /**
     * The custom public / web path defined by the developer.
     *
     * @var string
     */
    protected string $publicPath;

    /**
     * Create a new Illuminate application instance.
     *
     * @param  string|null  $basePath
     * @return void
     */
    public function __construct($basePath = null)
    {
        parent::__construct();

        if ($basePath) {
            $this->setBasePath($basePath);
        }

        $this->registerBaseBindings();
    }

    /**
     * Begin configuring a new Laravel application instance.
     *
     * @param string|null $basePath
     * @return ApplicationContainer
     */
    public static function configure(?string $basePath = null): static
    {
        return (new static($basePath));
    }

    /**
     * Register the basic bindings into the container.
     *
     * @return void
     */
    protected function registerBaseBindings(): void
    {
        static::setInstance($this);
    }

    /**
     * Set the base path for the application.
     *
     * @param string $path
     * @return ApplicationContainer
     */
    public function setBasePath(string $path): static
    {
        $this->basePath = rtrim($path, '\/');

        return $this;
    }

    /**
     * Join the given paths together.
     *
     * @param  string  $basePath
     * @param  string  $path
     * @return string
     */
    public function joinPaths($basePath, $path = ''): string
    {
        return join_paths($basePath, $path);
    }

    /**
     * Get the base path.
     *
     * @param string $path
     * @return string
     */
    public function basePath(string $path = ''): string
    {
        return $this->joinPaths($this->basePath, $path);
    }

    /**
     * Get the application path.
     *
     * @param string $path
     * @return string
     */
    public function path(string $path = ''): string
    {
        return $this->joinPaths($this->appPath ?? $this->basePath('src'), $path);
    }

    /**
     * Get the configuration path.
     *
     * @param string $path
     * @return string
     */
    public function configPath(string $path = ''): string
    {
        return $this->joinPaths($this->configPath ?? $this->basePath('config'), $path);
    }

    /**
     * Get the database path.
     *
     * @param string $path
     * @return string
     */
    public function databasePath(string $path = ''): string
    {
        return $this->joinPaths($this->databasePath ?? $this->basePath('database'), $path);
    }

    /**
     * Get the language files path.
     *
     * @param string $path
     * @return string
     */
    public function langPath(string $path = ''): string
    {
        return $this->joinPaths($this->langPath ?? $this->basePath('lang'), $path);
    }

    /**
     * Get the public path.
     *
     * @param string $path
     * @return string
     */
    public function publicPath(string $path = ''): string
    {
        return $this->joinPaths($this->publicPath ?? $this->basePath('public'), $path);
    }
}