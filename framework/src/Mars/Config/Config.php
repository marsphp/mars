<?php

namespace Mars\Config;

class Config
{
    protected array $config = [];

    public function merge(array $config): static
    {
        $this->config = array_merge($this->config, $config);

        return $this;
    }

    public function get(string $key, $default = null)
    {
        return dot($this->config)->get($key) ?? $default;
    }
}