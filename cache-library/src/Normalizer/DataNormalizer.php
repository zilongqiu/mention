<?php

namespace Qiu\Cache\Normalizer;

use Qiu\Cache\CacheItem;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class DataNormalizer
 */
class DataNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        if (!$this->supportsNormalization($object)) {
            throw new InvalidArgumentException('The object must be an instance of "Qiu\Cache\CacheItem".');
        }

        $data = [
            'key' => $object->getKey(),
            'value' => serialize($object->get()),
            'expiration-time' => $object->getExpirationTime(),
        ];

        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CacheItem;
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $this->assertHasKey('key', $data);
        $this->assertHasKey('value', $data);
        $this->assertHasKey('expiration-time', $data);

        $cacheItem = new CacheItem();
        $cacheItem->setKey($data['key']);
        $cacheItem->set(unserialize($data['value']));
        $cacheItem->setExpirationTime($data['expiration-time']);

        return $cacheItem;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return CacheItem::class === $type;
    }

    /**
     * @param string $key
     *
     * @throws \RuntimeException
     */
    protected function assertHasKey($key, array $data)
    {
        if (!array_key_exists($key, $data)) {
            throw new \RuntimeException(sprintf('Missing key "%s" in data.', $key));
        }
    }
}
