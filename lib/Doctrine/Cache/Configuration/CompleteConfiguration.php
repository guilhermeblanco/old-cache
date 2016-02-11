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

namespace Doctrine\Cache\Configuration;

use Doctrine\Cache\Converter;
use Doctrine\Cache\Expiry;
use Doctrine\Cache\Integration;

/**
 * {@link CompleteConfiguration} provides read-only configuration properties that are used by
 * {@link \Doctrine\Cache\CacheManager}s to configure {@link \Doctrine\Cache\Cache}s.
 *
 * @package Doctrine\Cache\Configuration
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class CompleteConfiguration
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
     * @param CompleteConfiguration $configuration
     *
     * @return CompleteConfiguration
     */
    public static function createFromConfiguration(CompleteConfiguration $configuration)
    {
        return new self(
            $configuration->getExpiryPolicy(),
            $configuration->getKeyConverter(),
            $configuration->getValueConverter(),
            $configuration->getCacheLoader(),
            $configuration->getCacheWriter()
        );
    }

    /**
     * CompleteConfiguration constructor.
     *
     * @param Expiry\ExpiryPolicy     $expiryPolicy
     * @param Converter\Converter     $keyConverter
     * @param Converter\Converter     $valueConverter
     * @param Integration\CacheLoader $cacheLoader
     * @param Integration\CacheWriter $cacheWriter
     */
    private function __construct(
        Expiry\ExpiryPolicy $expiryPolicy,
        Converter\Converter $keyConverter,
        Converter\Converter $valueConverter,
        Integration\CacheLoader $cacheLoader,
        Integration\CacheWriter $cacheWriter
    )
    {
        $this->expiryPolicy   = $expiryPolicy;
        $this->keyConverter   = $keyConverter;
        $this->valueConverter = $valueConverter;
        $this->cacheLoader    = $cacheLoader;
        $this->cacheWriter    = $cacheWriter;
    }

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
     * Checks if a cache should operate in write-through mode.
     *
     * When in write-through mode, cache update occurs as a result of "set" operations
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
}