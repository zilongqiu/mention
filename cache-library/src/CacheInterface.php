<?php

namespace Qiu\Cache;

/**
 * Interface CacheInterface
 */
interface CacheInterface
{
    /**
     * @param CacheItemInterface $cacheItem The cache item to be stored
     *
     * @return bool
     */
    public function set(CacheItemInterface $cacheItem);

    /**
     * @param string $key The unique key of this item in the cache
     * @param null|string $default The default value returned if the item is not found
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * @param string $key The cache item key
     *
     * @return bool
     */
    public function has($key);
}
