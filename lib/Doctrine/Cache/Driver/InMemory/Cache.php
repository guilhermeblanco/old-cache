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

use Doctrine\Cache\CachedValue;
use Doctrine\Cache\Configuration;
use Doctrine\Cache\Converter;
use Doctrine\Cache\Exception;
use Doctrine\Cache\Expiry;
use Doctrine\Cache\Integration;
use Doctrine\Cache\Processor;

/**
 * Class Cache
 *
 * @package Doctrine\Cache\Driver\InMemory
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class Cache implements \Doctrine\Cache\Cache
{
    /**
     * @var CacheManager
     */
    private $cacheManager;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Configuration\CacheConfiguration
     */
    private $configuration;

    /**
     * @var array
     */
    private $entryMap = [];

    /**
     * @var CacheStatistics
     */
    private $statistics;

    /**
     * @var bool
     */
    private $closed = false;

    /**
     * Cache constructor.
     *
     * @param CacheManager                     $cacheManager
     * @param string                           $name
     * @param Configuration\CacheConfiguration $configuration
     */
    public function __construct(
        CacheManager $cacheManager,
        string $name,
        Configuration\CacheConfiguration $configuration
    )
    {
        $this->cacheManager  = $cacheManager;
        $this->name          = $name;
        $this->configuration = $configuration;
        $this->statistics    = new CacheStatistics($this);
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMnaager() : CacheManager
    {
        return $this->cacheManager;
    }

    /**
     * {@inheritdoc}
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfiguration() : Configuration\CacheConfiguration
    {
        return $this->configuration;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatistics() : CacheStatistics
    {
        return $this->statistics;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $key)
    {
        $this->ensureOpen();

        $now            = microtime(true);
        $expiryPolicy   = $this->configuration->getExpiryPolicy();
        $keyConverter   = $this->configuration->getKeyConverter();
        $valueConverter = $this->configuration->getValueConverter();
        $internalKey    = $keyConverter->toInternal($key);
        $cachedValue    = $this->entryMap[$internalKey] ?? null;

        if ($cachedValue !== null && ! $cachedValue->isExpiredAt($now)) {
            $this->statistics->increaseCacheHits(1);

            $value = $valueConverter->fromInternal($cachedValue->getInternalValue());

            return $value;
        }

        $this->statistics->increaseCacheMisses(1);

        $value = $this->configuration->isReadThrough()
            ? $this->configuration->getCacheLoader()->load($key)
            : null;

        if ($value === null) {
            return null;
        }

        $creationDuration = $expiryPolicy->getExpiryForCreation();
        $expiryTime       = $creationDuration->getAdjustedTime($now);
        $cachedValue      = new CachedValue($valueConverter->toInternal($value), $now, $expiryTime);

        $this->entryMap[$internalKey] = $cachedValue;

        return $value;
    }

    /**
     * {@inheritdoc}
     */
    public function set(string $key, $value) : bool
    {
        $this->ensureOpen();

        // TODO: Implement set() method.
    }

    /**
     * {@inheritdoc}
     */
    public function isset(string $key) : bool
    {
        $this->ensureOpen();

        // TODO: Implement isset() method.
    }

    /**
     * {@inheritdoc}
     */
    public function unset(string $key) : bool
    {
        $this->ensureOpen();

        // TODO: Implement unset() method.
    }

    /**
     * {@inheritdoc}
     */
    public function invoke(
        string $key,
        Processor\EntryProcessor $processor,
        ...$arguments
    ) : Processor\EntryProcessorResult
    {
        // TODO: Implement invoke() method.
    }

    /**
     * {@inheritdoc}
     */
    public function close()
    {
        $this->closed = true;

        $this->cacheManager->releaseCache($this->name);
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
            throw Exception\IllegalStateException::cacheAlreadyClosed();
        }
    }

    /**
     * @return bool
     */
    private function isStatisticsEnabled() : bool
    {
        return $this->configuration->isStatisticsEnabled();
    }
}
