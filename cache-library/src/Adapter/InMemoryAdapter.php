<?php

namespace Qiu\Cache\Adapter;

use Qiu\Cache\CacheItemInterface;

/**
 * Class InMemoryAdapter
 */
class InMemoryAdapter extends AbstractAdapter
{
    /**
     * @var array
     */
    protected $items = array();

    /**
     * @param CacheItemInterface $cacheItem
     *
     * @return bool
     */
    public function set(CacheItemInterface $cacheItem)
    {
        $this->items[$cacheItem->getKey()] = $cacheItem;

        return true;
    }

    /**
     * @param string $key
     * @param null|string $default
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->items[$key];
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return isset($this->items[$key]);
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->items;
    }
}
