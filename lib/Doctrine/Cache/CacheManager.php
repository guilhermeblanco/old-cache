<?php

namespace Doctrine\Cache;

interface CacheManager
{
    public function createCache(string $name, CacheConfiguration $configuration) : Cache;

    public function getCache(string $name) : Cache;

    public function getCacheNameList() : array;

    public function destroyCache(string $name) : void;

    public function close() : void;

    public function enableStatistics(string $cacheName, boolean $enabled) : void;

    public function isClosed() : boolean;

    public function isSupported(string $feature) : boolean;
}