<?php

namespace Doctrine\Cache\Integration;

interface BulkCacheLoader
{
    public function loadAll(array $keyList) : array;
}