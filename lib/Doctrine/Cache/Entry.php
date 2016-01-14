<?php

namespace Doctrine\Cache;

interface Entry
{
    /**
     * Returns the key corresponding to this entry.
     *
     * @return string
     */
    public function getKey() : string;

    /**
     * Returns the value stored in the cache when this entry was created.
     *
     * @return mixed
     */
    public function getValue() : mixed;
}