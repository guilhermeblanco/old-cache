<?php

declare(strict_types = 1);

/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license. For more information, see
 * <http://www.doctrine-project.org>.
 */

namespace Doctrine\Cache;

/**
 * Interface BulkCache
 *
 * @package Doctrine\Cache
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface BulkCache
{
    /**
     * Gets a collection of entries from the Cache, returning them as Map of the values
     * associated with the set of keys requested.
     * If no argument is provided, it will return all entries stored under this cache.
     * Despite of performance implications and/or lock that may occur, not all drivers
     * may be able to support it, like Memcache.
     *
     * @param null|Collection<string> $keyList
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem fetching the keys.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          Fetching should only validate if keys are strings.
     *
     * @todo Discuss if this should return an Array or a Map.
     *
     * @return Map<string, mixed>
     */
    public function getAll(array $keyList = null) : array;

    /**
     * Copies all of the entries from the specified map to Cache.
     * The effect of this call is equivalent to that of calling set(key, value)
     * on this cache once for each mapping from key to value in the specified map.
     * Under drivers that are able to support XA Transactions, you will have an extra
     * level of consistency of operation.
     *
     * @param Map<string, mixed> $entryList
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem storing the entries.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          (useful when verifying key type, for example).
     *
     * @return boolean
     */
    public function setAll(array $entryList) : boolean;

    /**
     * Removes entries for the specified keys.
     * The order in which the individual removes will occur is undefined.
     * In case no argument is provided, all entries under this Cache will be removed.
     * Not all drivers may be able to support it, like Memcache.
     *
     * @param null|Collection<string> $keyList
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem removing the entries.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          Removing should only validate if keys are strings.
     * @return boolean
     */
    public function unsetAll(array $keyList = null) : boolean;

    /**
     * Invokes an EntryProcessor against the set of Entrys specified by the set of keys.
     * If an Entry does not exist for the specified key, an attempt is made to load it
     * (if a loader is configured) or a surrogate Entry, consisting of the key and a value
     * of null is provided.
     *
     * The order that the entries for the keys are processed is undefined. Implementations
     * may choose to process the entries in any order, including concurrently. Furthermore
     * there is no guarantee implementations will use the same EntryProcessor instance to
     * process each entry, as the case may be in a non-local cache topology.
     *
     * The result of executing the EntryProcessor is returned as a Map of EntryProcessorResults,
     * one result per key. Should the EntryProcessor or Caching implementation throw an exception,
     * the exception is wrapped and re-thrown when a call to EntryProcessorResult.get() is made.
     *
     * @param Collection<string>       $keyList
     * @param Processor\EntryProcessor $processor
     * @param mixed...                 $arguments
     *
     * @throws Exception\IllegalStateException  If the Cache Manager is closed.
     * @throws Exception\CommunicationException If there was a problem invoking the processor over entries.
     * @throws \InvalidArgumentException        If argument could not be properly validated.
     *                                          Removing should only validate if keys are strings.
     *
     * @return Map<string, Processor\EntryProcessorResult>
     */
    public function invokeAll(array $keyList, Processor\EntryProcessor $processor, ...$arguments) : array;
}