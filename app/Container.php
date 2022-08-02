<?php

namespace App;

use ReturnTypeWillChange;

class Container implements \ArrayAccess
{
    protected array $items = [];
    protected array $cache = [];

    #[ReturnTypeWillChange] public function offsetSet(mixed $offset, mixed $value)
    {
        $this->items[$offset] = $value;
    }

    #[ReturnTypeWillChange] public function offsetGet(mixed $offset)
    {
        if (!$this->has($offset)) {
            return null;
        }

        if (isset($this->cache[$offset])) {
            return $this->cache[$offset];
        }

        $item = $this->items[$offset]($this);

        $this->cache[$offset] = $item;

        return $item;
    }

    #[ReturnTypeWillChange] public function offsetUnset(mixed $offset)
    {
        if ($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }

    #[ReturnTypeWillChange] public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function has($offset): bool
    {
        return $this->offsetExists($offset);
    }

    public function __get($property)
    {
        return $this->offsetGet($property);
    }
}