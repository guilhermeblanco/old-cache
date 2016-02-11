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
 * {@link MutableConfiguration} provides a mutable implementation of {@link CompleteConfiguration} properties.
 *
 * @package Doctrine\Cache\Configuration
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class MutableConfiguration extends CompleteConfiguration
{
    /**
     * Define the expiration policy for cache entries.
     *
     * @param Expiry\ExpiryPolicy $expiryPolicy
     */
    public function setExpiryPolicy(Expiry\ExpiryPolicy $expiryPolicy)
    {
        $this->expiryPolicy = $expiryPolicy;
    }

    /**
     * Define the key converter for cache entries.
     *
     * @param Converter\Converter $converter
     */
    public function setKeyConverter(Converter\Converter $converter)
    {
        $this->keyConverter = $converter;
    }

    /**
     * Define the value converter for cache entries.
     *
     * @param Converter\Converter $converter
     */
    public function setValueConverter(Converter\Converter $converter)
    {
        $this->valueConverter = $converter;
    }

    /**
     * Define the cache loader.
     *
     * {@link Integration\CacheLoader} must be configured for read-through caches
     * to load values when cache miss occurs as a result of "get" operations.
     *
     * @param Integration\CacheLoader $loader
     */
    public function setCacheLoader(Integration\CacheLoader $loader)
    {
        $this->cacheLoader = $loader;
    }

    /**
     * Define the cache writer.
     *
     * {@link Integration\CacheWriter} must be configured for write-through caches
     * to store values when cache update occurs as a result of "set" operations.
     *
     * @param Integration\CacheWriter $writer
     */
    public function setCacheWriter(Integration\CacheWriter $writer)
    {
        $this->cacheWriter = $writer;
    }
}