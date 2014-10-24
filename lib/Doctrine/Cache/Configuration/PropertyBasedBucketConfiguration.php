<?php

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

use Doctrine\Cache\Expiry\ExpiryPolicy;
use Doctrine\Cache\Integration\CacheLoader;
use Doctrine\Cache\Integration\CacheWriter;

/**
 * Property based Bucket Configuration
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class PropertyBasedBucketConfiguration extends Properties implements BucketConfiguration
{
    /**
     * @var \Doctrine\Cache\Expiry\ExpiryPolicy
     */
    private $expiryPolicy;

    /**
     * @var \Doctrine\Cache\Integration\CacheLoader
     */
    private $cacheLoader;

    /**
     * @var \Doctrine\Cache\Integration\CacheWriter
     */
    private $cacheWriter;

    /**
     * Constructor.
     *
     * @param \Doctrine\Cache\Expiry\ExpiryPolicy      $expiryPolicy
     * @param \Doctrine\Cache\Configuration\Properties $properties
     */
    public function __construct(ExpiryPolicy $expiryPolicy, Properties $properties = null)
    {
        parent::__construct($properties);

        $this->expiryPolicy = $expiryPolicy;;
    }

    /**
     * {@inheritdoc}
     */
    public function getExpiryPolicy()
    {
        return $this->expiryPolicy;
    }

    /**
     * Define an optional bucket cache loader.
     *
     * @param \Doctrine\Cache\Integration\CacheLoader $cacheLoader
     */
    public function setCacheLoader(CacheLoader $cacheLoader = null)
    {
        $this->cacheLoader = $cacheLoader;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheLoader()
    {
        return $this->cacheLoader;
    }

    /**
     * Define an optional bucket cache writer.
     *
     * @param \Doctrine\Cache\Integration\CacheWriter $cacheWriter
     */
    public function setCacheWriter(CacheWriter $cacheWriter = null)
    {
        $this->cacheWriter = $cacheWriter;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheWriter()
    {
        return $this->cacheWriter;
    }
}
