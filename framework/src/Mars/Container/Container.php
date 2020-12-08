<?php

namespace Mars\Container;

use ArrayAccess;

/**
 * Class Container
 * @property mixed|void|null router
 * @property mixed|void|null errorHandler
 * @package Mars
 */
class Container implements ArrayAccess {

    /**
     * @var array
     */
    protected array $items = [];

    /**
     * @var array
     */
    protected array $cache = [];


    public function __construct(array $items = [])
    {
        foreach ($items as $key => $item) {
            $this->offsetSet($key, $item);
        }
    }

    /**
     * @param mixed $offset
     * @return bool|void
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed|void
     */
    public function offsetGet($offset)
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

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if ($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }

    /**
     * @param $offset
     * @return bool
     */
    public function has($offset): bool
    {
        return $this->offsetExists($offset);
    }

    /**
     * @param $property
     * @return mixed|void|null
     */
    public function __get($property)
    {
        return $this->offsetGet($property);
    }
}