<?php

namespace Qiu\Cache\Adapter;

use Qiu\Cache\CacheItem;
use Qiu\Cache\CacheItemInterface;
use Qiu\Cache\Normalizer\DataNormalizer;

/**
 * Class FilesystemAdapter
 */
class FilesystemAdapter extends AbstractAdapter
{
    /**
     * The cache directory
     */
    protected $directory = null;

    /**
     * @var DataNormalizer
     */
    protected $normalizer;

    /**
     * FilesystemAdapter constructor.
     *
     * @param string $directory
     * @param DataNormalizer $normalizer
     */
    public function __construct($directory, DataNormalizer $normalizer = null)
    {
        if (!file_exists($directory)) {
            @mkdir($directory, 0777, true);
        }

        $directory .= \DIRECTORY_SEPARATOR;
        $this->directory = $directory;
        $this->normalizer = $normalizer ?: new DataNormalizer();
    }

    /**
     * @param string $key
     * @param null|string $default
     *
     * @return mixed|null
     */
    public function get($key, $default = null)
    {
        if (!$this->has($key)) {
            return $default;
        }

        $data = json_decode(file_get_contents($this->getFile($key)), true);

        return $this->normalizer->denormalize($data, CacheItem::class);
    }

    /**
     * @param CacheItemInterface $cacheItem
     *
     * @return bool
     */
    public function set(CacheItemInterface $cacheItem)
    {
        $file = $this->getFile($cacheItem->getKey());
        file_put_contents($file, json_encode($this->normalizer->normalize($cacheItem)));

        if ($cacheItem->getExpirationTime()) {
            touch($file, $cacheItem->getExpirationTime());
        }

        return true;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function has($key)
    {
        return file_exists($this->getFile($key));
    }

    /**
     * @param string $key
     *
     * @return string
     */
    private function getFile($key)
    {
        $hash = base64_encode(hash('md5', $key, true));

        return $this->directory.$hash;
    }
}
