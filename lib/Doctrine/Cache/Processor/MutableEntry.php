<?php

namespace Doctrine\Cache\Processor;

use Doctrine\Cache\Entry;

/**
 * A mutable representation of an Entry.
 */
interface MutableEntry extends Entry
{
    /**
     * Checks for the existence of the entry in the cache.
     *
     * @return boolean
     */
    public function exists() : boolean;

    /**
     * Removes the entry from the Cache.
     *
     * This has the same semantics as calling Cache.remove(K).
     */
    public function remove() : void;

    /**
     * Sets or replaces the value associated with the key.
     *
     * If exists() is false and setValue is called then a mapping is added to the
     * cache visible once the EntryProcessor completes. Moreover a second invocation
     * of exists() will return true.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function setValue(mixed $value) : mixed;
}