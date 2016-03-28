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

namespace Doctrine\Cache\Driver\InMemory;

use Doctrine\Cache\CacheStatistics;
use Doctrine\Cache\Configuration;
use Doctrine\Cache\Exception;

/**
 * InMemory CacheManager
 *
 * @package Doctrine\Cache\Driver\InMemory
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class CacheManager implements \Doctrine\Cache\CacheManager
{
    /**
     * @var array
     */
    private $cacheMap = [];

    /**
     * @var bool
     */
    private $closed = false;

    /**
     * {@inheritdoc}
     */
    public function createCache(string $cacheName, Configuration\CacheConfiguration $configuration) : Cache
    {
        $this->ensureOpen();

        if (isset($this->cacheMap[$cacheName])) {
            throw new \InvalidArgumentException(sprintf('A cache named "%s" already exists', $cacheName));
        }

        $cache = new Cache($this, $cacheName, $configuration);

        return $this->cacheMap[$cacheName] = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function getCache(string $cacheName) : Cache
    {
        $this->ensureOpen();

        if (! isset($this->cacheMap[$cacheName])) {
            throw new \InvalidArgumentException(sprintf('A cache named "%s" does not exists', $cacheName));
        }

        return $this->cacheMap[$cacheName];
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheNameList() : array
    {
        $this->ensureOpen();

        return array_keys($this->cacheMap);
    }

    /**
     * {@inheritdoc}
     */
    public function destroyCache(string $cacheName)
    {
        $this->ensureOpen();

        $this->getCache($cacheName)->close();
    }

    /**
     * Releases the {@link Cache} with the specified name from being managed by this {@link CacheManager}.
     *
     * @param string $cacheName
     */
    public function releaseCache(string $cacheName)
    {
        unset($this->cacheMap[$cacheName]);
    }

    /**
     * {@inheritdoc}
     */
    public function getStatistics(string $cacheName) : CacheStatistics
    {
        $this->ensureOpen();

        return $this->getCache($cacheName)->getStatistics();
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        $this->closed = true;

        foreach ($this->cacheMap as $cache) {
            $cache->close();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isClosed() : bool
    {
        return $this->closed;
    }

    /**
     * @throws Exception\IllegalStateException
     */
    private function ensureOpen()
    {
        if ($this->closed) {
            throw Exception\IllegalStateException::alreadyClosed('Cache Manager');
        }
    }
}