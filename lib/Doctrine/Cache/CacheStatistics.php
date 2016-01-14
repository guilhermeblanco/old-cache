<?php

namespace Doctrine\Cache;

interface CacheStatistics
{
    public function clear() : void;

    public function getAverageGetTime() : float;

    public function getAverageSetTime() : float;

    public function getAverageUnsetTime() : float;

    public function getCacheEvictions() : integer;

    public function getCacheGets() : integer;

    public function getCacheSets() : integer;

    public function getCacheUnsets() : integer;

    public function getCacheHitsPercentage() : float;

    public function getCacheMissesPercentage() : float;

    public function getCacheHits() : integer;

    public function getCacheMisses() : integer;
}