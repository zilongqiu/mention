<?php

namespace Qiu\Cache;

/**
 * Class CacheItem
 */
class CacheItem implements CacheItemInterface
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var int|null
     */
    protected $expirationTime;

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param $key
     *
     * @return self
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     *
     * @return self
     */
    public function set($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getExpirationTime()
    {
        return $this->expirationTime;
    }

    /**
     * @param int|null $time
     *
     * @return self
     */
    public function setExpirationTime($time = null)
    {
        $this->expirationTime = $time;

        return $this;
    }
}
