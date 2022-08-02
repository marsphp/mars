<?php

namespace App;

class Container implements \ArrayAccess
{
    protected array $items = [];

    public function offsetSet(mixed $offset, mixed $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetGet(mixed $offset)
    {
        if (!$this->has($offset)) {
            return null;
        }

        return $this->items[$offset]();
    }

    public function offsetUnset(mixed $offset)
    {
        if($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }

    public function offsetExists(mixed $offset): bool
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