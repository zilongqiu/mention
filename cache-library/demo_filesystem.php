<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/RandomObject.php';

$cache = new Qiu\Cache\Adapter\FilesystemAdapter('/tmp');


// non existing key
var_dump($cache->get('heyyyy'));


// "text" cached
$cacheItem = new \Qiu\Cache\CacheItem();
$cacheItem->setKey('key')
    ->set('testtest');
$cache->set($cacheItem);
var_dump($cache->get('key'));


// "array" cached
$cacheItem2 = new \Qiu\Cache\CacheItem();
$cacheItem2->setKey('testArray')
    ->set(['toto', 'titi', 'tata', 0 => 'ok']);
$cache->set($cacheItem2);
var_dump($cache->get('testArray'));


// "object" cached
$cacheItem3 = new \Qiu\Cache\CacheItem();
$cacheItem3->setKey('testObject')
    ->set(new RandomObject());
$cache->set($cacheItem3);
var_dump($cache->get('testObject'));
