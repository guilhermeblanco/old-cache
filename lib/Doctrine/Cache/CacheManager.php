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

namespace Doctrine\Cache;

use Doctrine\Cache\Configuration\BucketConfiguration;
use Doctrine\Cache\Configuration\Properties;

/**
 * Class CacheManager
 *
 * @package Doctrine\Cache
 */
class CacheManager
{
    private $bucketMap = [];

    /**
     * @param string              $name
     * @param BucketConfiguration $configuration
     *
     * @return CacheBucket
     */
    public function createBucket($name, BucketConfiguration $configuration) : CacheBucket
    {
        if (isset($this->bucketMap[$name])) {
            throw new \InvalidArgumentException(sprintf('A cache named "%s" already exists', $name));
        }

        $this->bucketMap[$name] = new CacheBucket($this, $name, $configuration);

        return $this->bucketMap[$name];
    }

    /**
     * @param string $name
     *
     * @return CacheBucket
     */
    public function getBucket($name) : CacheBucket
    {
        return isset($this->bucketMap[$name])
            ? $this->bucketMap[$name]
            : null;
    }

    /**
     * @param string              $name
     * @param BucketConfiguration $configuration
     *
     * @return CacheBucket
     */
    public function getOrCreateBucket($name, BucketConfiguration $configuration) : CacheBucket
    {
        $bucket = $this->getBucket($name);

        if ($bucket) {
            return $bucket;
        }

        return $this->createBucket($name, $configuration);
    }

    /**
     * @param string $name
     */
    public function destroyBucket($name)
    {
        unset($this->bucketMap[$name]);
    }

    /**
     * @return array
     */
    public function getBucketNames() : array
    {
        return array_keys($this->bucketMap);
    }
}