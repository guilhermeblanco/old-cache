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

/**
 * Class CacheStatistics
 *
 * @package Doctrine\Cache\Driver\InMemory
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class CacheStatistics implements \Doctrine\Cache\CacheStatistics
{
    /**
     * @var Cache
     */
    private $cache;

    /**
     * @var int
     */
    private $cacheUnsets = 0;

    /**
     * @var int
     */
    private $cacheExpiries = 0;

    /**
     * @var int
     */
    private $cacheSets = 0;

    /**
     * @var int
     */
    private $cacheHits = 0;

    /**
     * @var int
     */
    private $cacheMisses = 0;

    /**
     * @var int
     */
    private $cacheEvictions = 0;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->cacheUnsets    = 0;
        $this->cacheExpiries  = 0;
        $this->cacheSets      = 0;
        $this->cacheHits      = 0;
        $this->cacheMisses    = 0;
        $this->cacheEvictions = 0;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheEvictions() : int
    {
        return $this->cacheEvictions;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheGets() : int
    {
        return $this->cacheHits + $this->cacheMisses;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheSets() : int
    {
        return $this->cacheSets;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheUnsets() : int
    {
        return $this->cacheUnsets;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheHitPercentage() : float
    {
        return $this->cacheHits !== 0
            ? ($this->cacheHits / $this->getCacheGets()) * 100
            : 0
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMissPercentage() : float
    {
        return $this->cacheMisses !== 0
            ? ($this->cacheMisses / $this->getCacheGets()) * 100
            : 0
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheHits() : int
    {
        return $this->cacheHits;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheMisses() : int
    {
        return $this->cacheMisses;
    }
}