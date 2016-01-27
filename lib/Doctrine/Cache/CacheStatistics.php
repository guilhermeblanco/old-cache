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

/**
 * Cache statistics.
 *
 * Statistics are accumulated from the time a cache is created. They can be reset to zero using clear().
 *
 * There are no defined consistency semantics for statistics. Refer to the implementation for precise semantics.
 *
 * @package Doctrine\Cache
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface CacheStatistics
{
    /**
     * Clears the statistics counters to 0 for the associated Cache.
     *
     */
    public function clear();

    /**
     * The mean time to execute gets.
     * In a read-through cache the time taken to load an entry on miss is not included in get time.
     *
     * @return float the time in microseconds
     */
    public function getAverageGetTime() : float;

    /**
     * The mean time to execute sets.
     *
     * @return float the time in microseconds
     */
    public function getAverageSetTime() : float;

    /**
     * The mean time to execute unsets.
     *
     * @return float the time in microseconds
     */
    public function getAverageUnsetTime() : float;

    /**
     * The total number of evictions from the cache. An eviction is a removal initiated by the cache itself to free up
     * space. An eviction is not treated as a removal and does not appear in the removal counts.
     *
     * @return int the number of evictions
     */
    public function getCacheEvictions() : int;

    /**
     * The total number of requests to the cache. This will be equal to the sum of the hits and misses.
     * A "get" is an operation that returns the current or previous value. It does not include checking for the
     * existence of a key.
     *
     * In a caches with multiple tiered storage, a gets may be implemented as a get to the cache or to the first tier.
     *
     * @return int the number of gets
     */
    public function getCacheGets() : int;

    /**
     * The total number of sets to the cache.
     * A set is counted even if it is immediately evicted.
     *
     * Replaces, where a set occurs which overrides an existing mapping is counted as a set.
     *
     * @return int the number of sets
     */
    public function getCacheSets() : int;

    /**
     * The total number of unsets from the cache. This does not include evictions, where the cache itself initiates the
     * removal to make space.
     *
     * @return int the number of unsets
     */
    public function getCacheUnsets() : int;

    /**
     * This is a measure of cache efficiency.
     * It is calculated as: getCacheHits() divided by () * 100.
     *
     * @return float the percentage of successful hits, as a decimal e.g 75.
     */
    public function getCacheHitsPercentage() : float;

    /**
     * Returns the percentage of cache accesses that did not find a requested entry in the cache.
     * This is calculated as getCacheMisses() divided by getCacheGets() * 100.
     *
     * @return float the percentage of accesses that failed to find anything
     */
    public function getCacheMissesPercentage() : float;

    /**
     * The number of get requests that were satisfied by the cache.
     * Cache.isset(string) is not a get request for statistics purposes.
     *
     * In a caches with multiple tiered storage, a hit may be implemented as a hit to the cache or to the first tier.
     *
     * For an EntryProcessor, a hit occurs when the key exists and an entry processor can be invoked against it, even
     * if no methods of Entry or MutableEntry are called.
     *
     * @return int the number of hits
     */
    public function getCacheHits() : int;

    /**
     * A miss is a get request that is not satisfied.
     * In a simple cache a miss occurs when the cache does not satisfy the request.
     *
     * Cache.isset(string) is not a get request for statistics purposes.
     *
     * For an EntryProcessor, a miss occurs when the key does not exist and an entry processor cannot be invoked.
     *
     * In a caches with multiple tiered storage, a miss may be implemented as a miss to the cache or to the first tier.
     *
     * In a read-through cache a miss is an absence of the key in the cache that will trigger a call to a CacheLoader.
     * So it is still a miss even though the cache will load and return the value.
     *
     * Refer to the implementation for precise semantics.
     *
     * @return int the number of misses
     */
    public function getCacheMisses() : int;
}