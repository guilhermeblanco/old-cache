<?php

namespace Doctrine\Cache;

/**
 * A Cache is a Map-like data structure that provides temporary storage of application data.
 * Unlike Maps, Caches
 *
 * 1. do not allow null keys or values. Attempts to use null will result in a InvalidArgumentException
 * 2. provide the ability to read values from a CacheLoader (read-through-caching) when a value being requested is not in a cache
 * 3. provide the ability to write values to a CacheWriter (write-through-caching) when a value being created/updated/removed from a cache
 * 4. provide the ability to observe cache entry changes
 * 5. may capture and measure operational statistics
 */
interface Cache
{
    public function getName() : string;

    public function getCacheManager() : CacheManager;

    public function getConfiguration() : CacheConfiguration;

    public function getStatistics() : CacheStatistics;

    public function close() : void;

    public function isClose() : boolean;

    /**
     * Gets an entry from the cache.
     *
     * If the cache is configured to use read-through, and get would return null because
     * the entry is missing from the cache, the Cache's CacheLoader is called in an
     * attempt to load the entry.
     *
     * @param string $key
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem fetching the key.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          Fetching should only validate if keys is a string.
     *
     * @return mixed|null
     */
    public function get(string $key) : mixed;

    /**
     * Associates the specified value with the specified key in the cache.
     *
     * If the Cache previously contained a mapping for the key, the old value is replaced
     * by the specified value. (A cache c is said to contain a mapping for a key k if and
     * only if c.isset(k) would return true.)
     *
     * @param string $key
     * @param mixed  $value
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem storing the entry.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          (useful when verifying key type, for example).
     *
     * @return boolean
     */
    public function set(string $key, mixed $value) : boolean;

    /**
     * Determines if the Cache contains an entry for the specified key.
     *
     * More formally, returns true if and only if this cache contains a mapping
     * for a key k such that key === k. (There can be at most one such mapping.)
     *
     * @param string $key
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem verifying the key.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          Verifying should only validate if key is a string.
     *
     * @return boolean
     */
    public function isset(string $key) : boolean;

    /**
     * Removes the mapping for a key from this cache if it is present.
     *
     * More formally, if this cache contains a mapping from key k to value v such
     * that (key === null ? k === null : key === k), that mapping is removed.
     * (The cache can contain at most one such mapping.)
     *
     * Returns true if this cache previously associated the key, or false if the
     * cache contained no mapping for the key.
     *
     * The cache will not contain a mapping for the specified key once the call returns.
     *
     * @parma string $key
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem removing the entry.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          Removing should only validate if key is a string.
     *
     * @return boolean
     */
    public function unset(string $key) : boolean;

    public function invoke(string $key, Processor\EntryProcessor $processor, ...$arguments) : Processor\EntryProcessorResult;
}