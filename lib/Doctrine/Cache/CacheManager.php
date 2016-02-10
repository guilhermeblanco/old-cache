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
 * A {@link CacheManager} provides a means of establishing, configuring, acquiring, closing and destroying uniquely
 * named {@link Cache}s.
 *
 * Implementations of CacheManager may additionally provide and share external resources between the Caches being
 * managed, for example, the content of the managed Caches may be stored in the same cluster.
 *
 * @package Doctrine\Cache
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface CacheManager
{
    /**
     * Creates a named {@link Cache}.
     *
     * If a {@link Cache} with the specified name is known to the {@link CacheManager}, a CacheException is thrown.
     *
     * If a {@link Cache} with the specified name is unknown the {@link CacheManager}, one is created according to the
     * provided {@link CacheConfiguration} after which it becomes managed by the {@link CacheManager}.
     *
     * Prior to a {@link Cache} being created, the provided {@link CacheConfiguration}s is validated within the context
     * of the {@link CacheManager} properties and implementation.
     *
     * Implementers should be aware that same {@link CacheConfiguration} may be used to configure other {@link Cache}s.
     *
     * Implementations may support the use of declarative mechanisms to pre-configure {@link Cache}s, thus removing the
     * requirement to configure them in an application.  In such circumstances, a developer may simply call the
     * {@link #getCache(String)} method to acquire a previously established or pre-configured {@link Cache}.
     *
     * @param string                           $cacheName     the name of the {@link Cache}
     * @param Configuration\CacheConfiguration $configuration a {@link CacheConfiguration} for the {@link Cache}
     *
     * @return Cache
     *
     * @throws Exception\IllegalStateException         if the {@link CacheManager} {@link #isClosed()}
     * @throws Exception\CommunicationException        if there was an error configuring the {@link Cache}
     * @throws Exception\UnsupportedOperationException if the configuration specifies an unsupported feature
     * @throws \InvalidArgumentException               if the cache name is an empty string or name is already in use
     */
    public function createCache(string $cacheName, Configuration\CacheConfiguration $configuration) : Cache;

    /**
     * Looks up a managed {@link Cache} given its name.
     *
     * @param string $cacheName the name of the cache to look for
     *
     * @return Cache
     *
     * @throws Exception\IllegalStateException if the CacheManager is {@link #isClosed()}
     * @throws \InvalidArgumentException       if there is no {@link Cache} configured under requested cache name
     */
    public function getCache(string $cacheName) : Cache;

    /**
     * Obtains a {@link Traversable} over the names of {@link Cache}s managed by the {@link CacheManager}.
     *
     * {@link Traversable}s returned is immutable. Any attempt to modify of the {@link Traversable}, including remove,
     * will raise an {@link Exception\IllegalStateException}.  If the {@link Cache}s managed by the {@link CacheManager}
     * change, the {@link Traversable} is not affected.
     *
     * Array returned may not provide all of the {@link Cache}s managed by the {@link CacheManager}.
     * For example: Internally defined or platform specific {@link Cache}s that may be accessible by a call to
     * {@link #getCache(String)} may not be present in an iteration.
     *
     * @return array
     *
     * @throws Exception\IllegalStateException if the CacheManager is {@link #isClosed()}
     */
    public function getCacheNameList() : array;

    /**
     * Destroys a specifically named and managed {@link Cache}. Once destroyed a new {@link Cache} of the same name may
     * be configured.
     *
     * This is equivalent to the following sequence of method calls:
     *
     * - {@link Cache#clear()}
     * - {@link Cache#close()}
     *
     * followed by allowing the name of the {@link Cache} to be used for other {@link Cache} configurations.
     *
     * From the time this method is called, the specified {@link Cache} is not available for operational use. An attempt
     * to call an operational method on the {@link Cache} will throw an {@link Exception\IllegalStateException}.
     *
     * @param string $cacheName the cache to destroy
     *
     * @throws Exception\IllegalStateException if the {@link CacheManager} is {@link #isClosed()}
     * @throws \InvalidArgumentException       if the cache name is an empty string or name is not in use
     */
    public function destroyCache(string $cacheName);

    /**
     * Enables or disables statistics gathering for a managed {@link Cache}.
     *
     * @param string $cacheName the cache to enable statistics
     * @param bool   $enabled
     *
     * @throws Exception\IllegalStateException         if the {@link CacheManager} is {@link #isClosed()}
     * @throws Exception\UnsupportedOperationException if the {@link Cache} does not support statistics
     * @throws \InvalidArgumentException               if the cache name is an empty string or name is not in use
     */
    public function enableStatistics(string $cacheName, boolean $enabled);

    /**
     * Retrieve statistics gathered by a managed {@link Cache}.
     *
     * @param string $cacheName the cache to retrieve statistics
     *
     * @return CacheStatistics
     *
     * @throws Exception\IllegalStateException         if the {@link CacheManager} is {@link #isClosed()}
     * @throws Exception\UnsupportedOperationException if the {@link Cache} does not support statistics
     * @throws \InvalidArgumentException               if the cache name is an empty string or name is not in use
     */
    public function getStatistics(string $cacheName) : CacheStatistics;

    /**
     * Closes the {@link CacheManager}.
     *
     * For each {@link Cache} managed by the {@link CacheManager}, the {@link Cache#close()} method will be invoked, in
     * no guaranteed order. If a {@link Cache#close()} call throws an exception, the exception will be ignored.
     *
     * After executing this method, the {@link #isClosed()} method will return <code>true</code>.
     *
     * All attempts to close a previously closed {@link CacheManager} will be ignored.
     */
    public function close();

    /**
     * Determines whether the {@link CacheManager} instance has been closed. A {@link CacheManager} is considered closed
     * when the {@link #close()} method has been called.
     *
     * This method generally cannot be called to determine whether the {@link CacheManager} is valid or invalid. A
     * typical client can determine that a {@link CacheManager} is invalid by catching any exceptions that might be
     * thrown when an operation is attempted.
     *
     * @return bool true if this {@link CacheManager} instance is closed; false if it is still open
     */
    public function isClosed() : bool;

    /**
     * Determines whether an optional feature is supported by the {@link CacheManager}.
     *
     * @param string $feature the feature to check for
     *
     * @return bool true if the feature is supported, false otherwise
     */
    //public function isSupported(string $feature) : bool;
}