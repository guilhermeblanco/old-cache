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

namespace Doctrine\Cache\Configuration;

use Doctrine\Cache\Converter;
use Doctrine\Cache\Expiry;
use Doctrine\Cache\Integration;

/**
 * CacheConfiguration provides relevant configuration properties
 * that are used by CacheManagers to configure Caches.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 *
 * @package Doctrine\Cache\Configuration
 */
class CacheConfiguration
{
    /**
     * @var Expiry\ExpiryPolicy
     */
    protected $expiryPolicy;

    /**
     * @var Converter\Converter
     */
    protected $keyConverter;

    /**
     * @var Converter\Converter
     */
    protected $valueConverter;

    /**
     * @var Integration\CacheLoader
     */
    protected $cacheLoader;

    /**
     * @var Integration\CacheWriter
     */
    protected $cacheWriter;

    /**
     * @var bool
     */
    protected $statisticsEnabled = false;

    /**
     * Retrieve the expiration policy for cache entries.
     *
     * The default value is an {@link Expiry\EternalExpiryPolicy}.
     *
     * @return Expiry\ExpiryPolicy
     */
    public function getExpiryPolicy() : Expiry\ExpiryPolicy
    {
        if ($this->expiryPolicy === null) {
            $this->expiryPolicy = new Expiry\EternalExpiryPolicy();
        }

        return $this->expiryPolicy;
    }

    /**
     * Define the expiration policy for cache entries.
     *
     * @param Expiry\ExpiryPolicy $expiryPolicy
     */
    public function setExpiryPolicy(Expiry\ExpiryPolicy $expiryPolicy) : void
    {
        $this->expiryPolicy = $expiryPolicy;
    }

    /**
     * Retrieve the key converter for cache entries.
     *
     * The default value is an {@link Converter\AsIsConverter}.
     *
     * @return Converter\Converter
     */
    public function getKeyConverter() : Converter\Converter
    {
        if ($this->keyConverter === null) {
            $this->keyConverter = new Converter\AsIsConverter();
        }

        return $this->keyConverter;
    }

    /**
     * Define the key converter for cache entries.
     *
     * @param Converter\Converter $converter
     */
    public function setKeyConverter(Converter\Converter $converter) : void
    {
        $this->keyConverter = $converter;
    }

    /**
     * Retrieve the value converter for cache entries.
     *
     * The default value is a {@link Converter\SerializeConverter}.
     *
     * @return Converter\Converter
     */
    public function getValueConverter() : Converter\Converter
    {
        if ($this->valueConverter === null) {
            $this->valueConverter = new Converter\SerializeConverter();
        }

        return $this->valueConverter;
    }

    /**
     * Define the value converter for cache entries.
     *
     * @param Converter\Converter $converter
     */
    public function setValueConverter(Converter\Converter $converter) : void
    {
        $this->valueConverter = $converter;
    }

    /**
     * Checks if a cache should operate in read-through mode.
     *
     * When in read-through mode, cache miss occurs as a result of non-existing cache entry
     * key will issue the configured {@link Integration\CacheLoader} to be invoked.
     *
     * @return bool
     */
    public function isReadThrough() : bool
    {
        return $this->cacheLoader !== null;
    }

    /**
     * Retrieve the cache loader.
     *
     * The default value is null.
     *
     * @return Integration\CacheLoader
     */
    public function getCacheLoader() : Integration\CacheLoader
    {
        return $this->cacheLoader;
    }

    /**
     * Define the cache loader.
     *
     * {@link Integration\CacheLoader} must be configured for read-through caches
     * to load values when cache miss occurs as a result of "get" operations.
     *
     * @param Integration\CacheLoader $loader
     */
    public function setCacheLoader(Integration\CacheLoader $loader) : void
    {
        $this->cacheLoader = $loader;
    }

    /**
     * Checks if a cache should operate in write-through mode.
     *
     * When in write-through mode, cache update occurs as a result of "put" operations
     * will issue the configured {@link Integration\CacheWriter} to be invoked.
     *
     * @return bool
     */
    public function isWriteThrough() : bool
    {
        return $this->cacheWriter !== null;
    }

    /**
     * Retrieve the cache writer.
     *
     * The default value is null.
     *
     * @return Integration\CacheWriter
     */
    public function getCacheWriter() : Integration\CacheWriter
    {
        return $this->cacheWriter;
    }

    /**
     * Define the cache writer.
     *
     * {@link Integration\CacheWriter} must be configured for write-through caches
     * to store values when cache update occurs as a result of "put" operations.
     *
     * @param Integration\CacheWriter $writer
     */
    public function setCacheWriter(Integration\CacheWriter $writer) : void
    {
        $this->cacheWriter = $writer;
    }

    /**
     * Enable/Disable cache statistics.
     *
     * @param bool $enabled
     */
    public function setStatisticsEnabled(boolean $enabled) : void
    {
        $this->statisticsEnabled = $enabled;
    }

    /**
     * Checks whether statistics gathering is enabled.
     *
     * @return bool
     */
    public function isStatisticsEnabled() : bool
    {
        return $this->statisticsEnabled;
    }
}