<?php

namespace Doctrine\Cache;

interface IterableCache
{
    /**
     * @return \Iterator<Entry>
     */
    public function iterator() : \Iterator;
}