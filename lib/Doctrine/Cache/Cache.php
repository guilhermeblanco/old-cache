<?php

declare(strict_types = 1);

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
 * INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
 * USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals and is licensed under the MIT license.
 * For more information, see <http://www.doctrine-project.org>.
 */

namespace Doctrine\Cache;

use Doctrine\Cache\Configuration\CacheConfiguration;

/**
 * A Cache is a Map-like data structure that provides temporary storage of application data. Unlike Maps, Caches:
 *
 * 1. do not allow null keys or values. Attempts to use null will result in a InvalidArgumentException
 * 2. provide ability to read values from a CacheLoader (read-through) when a value is requested and is not in a cache
 * 3. provide ability to write values to a CacheWriter (write-through) when a value is created/updated/removed from a
 * cache
 *
 * @package Doctrine\Cache
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface Cache
{
    public function getCacheManager() : CacheManager;

    public function getName() : string;

    public function getStatistics() : CacheStatistics;

    /**
     * Gets an entry from the cache.
     *
     * If the cache is configured to use read-through, and get would return null because the entry is missing from the
     * cache, the Cache's CacheLoader is called in an attempt to load the entry.
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
    public function get(string $key);

    /**
     * Associates the specified value with the specified key in the cache.
     *
     * If the Cache previously contained a mapping for the key, the old value is replaced by the specified value.
     * (A cache c is said to contain a mapping for a key k if and only if c.isset(k) would return true.)
     *
     * @param string $key
     * @param mixed  $value
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem storing the entry.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          (useful when verifying key type, for example).
     *
     * @return bool
     */
    public function set(string $key, $value) : bool;

    /**
     * Determines if the Cache contains an entry for the specified key.
     *
     * More formally, returns true if and only if this cache contains a mapping for a key k such that key === k.
     * (There can be at most one such mapping.)
     *
     * @param string $key
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem verifying the key.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          Verifying should only validate if key is a string.
     *
     * @return bool
     */
    public function isset(string $key) : bool;

    /**
     * Removes the mapping for a key from this cache if it is present.
     *
     * More formally, if this cache contains a mapping from key k to value v such that
     * (key === null ? k === null : key === k), that mapping is removed.
     * (The cache can contain at most one such mapping.)
     *
     * Returns true if this cache previously associated the key, or false if the cache contained no mapping for the key.
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
     * @return bool
     */
    public function unset(string $key) : bool;

    public function invoke(string $key, Processor\EntryProcessor $processor, ...$arguments) : Processor\EntryProcessorResult;

    public function close();

    public function isClosed() : bool;
}