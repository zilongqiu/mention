<?php

namespace Qiu\Cache;

/**
 * Interface CacheItemInterface
 */
interface CacheItemInterface
{
    /**
     * Returns the key string for this cache item.
     *
     * @return string
     */
    public function getKey();

    /**
     * Sets the key for this cache item.
     *
     * @return self
     */
    public function setKey($key);

    /**
     * Return the value represented by this cache item.
     *
     * @return mixed
     */
    public function get();

    /**
     * Sets the value represented by this cache item.
     *
     * @param mixed $value
     *
     * @return self
     */
    public function set($value);

    /**
     * Return the expiration time for this cache item.
     *
     * @return int|null
     */
    public function getExpirationTime();

    /**
     * Sets the expiration time for this cache item.
     *
     * @param int|null $time
     *
     * @return self
     */
    public function setExpirationTime($time);
}
