<?php

namespace Doctrine\Cache\Integration;

interface BulkCacheWriter
{
    public function writeAll(array $entryList) : void;

    public function deleteAll(array $keyList) : void;
}