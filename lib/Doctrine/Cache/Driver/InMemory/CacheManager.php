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

use Doctrine\Cache\Configuration;
use Doctrine\Cache\Exception\IllegalStateException;

/**
 * Class CacheManager
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
    public function createCache(string $name, Configuration\CacheConfiguration $configuration) : \Doctrine\Cache\Cache
    {
        assert(! $this->closed, IllegalStateException::managerAlreadyClosed());
        assert(
            ! isset($this->cacheMap[$name]),
            new \InvalidArgumentException(sprintf('A cache named "%s" already exists', $name))
        );

        $this->cacheMap[$name] = new Cache($this, $name, $configuration);

        return $this->cacheMap[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getCache(string $name) : Cache
    {
        assert(! $this->closed, IllegalStateException::managerAlreadyClosed());
        assert(
            isset($this->cacheMap[$name]),
            new \InvalidArgumentException(sprintf('A cache named "%s" does not exist', $name))
        );

        return $this->cacheMap[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheNameList() : array
    {
        assert(! $this->closed, IllegalStateException::managerAlreadyClosed());

        return new ArrayIterator(array_keys($this->cacheMap));
    }

    /**
     * {@inheritdoc}
     */
    public function destroyCache(string $name)
    {
        assert(! $this->closed, IllegalStateException::managerAlreadyClosed());

        unset($this->cacheMap[$name]);
    }

    /**
     * {@inheritdoc}
     */
    public function enableStatistics(string $cacheName, boolean $enabled)
    {
        assert(! $this->closed, IllegalStateException::managerAlreadyClosed());

        // TODO: Implement enableStatistics() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getStatistics(string $cacheName) : \Doctrine\Cache\CacheStatistics
    {
        assert(! $this->closed, IllegalStateException::managerAlreadyClosed());

        // TODO: Implement getStatistics() method.
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
        // TODO: Implement isClosed() method.
    }

    /**
     * {@inheritdoc}
     */
    public function isSupported(string $feature) : bool
    {
        // TODO: Implement isSupported() method.
    }
}