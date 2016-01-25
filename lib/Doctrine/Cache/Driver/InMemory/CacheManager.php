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

namespace Doctrine\Cache\Driver\InMemory;

use Doctrine\Cache\Cache;
use Doctrine\Cache\Configuration;

/**
 * Class CacheManager
 *
 * @package Doctrine\Cache\Driver\InMemory
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class CacheManager implements \Doctrine\Cache\CacheManager
{
    private $cacheMap = [];

    public function createCache(string $name, Configuration\CacheConfiguration $configuration) : Cache
    {
        // TODO: Implement createCache() method.
    }

    public function getCache(string $name) : Cache
    {
        // TODO: Implement getCache() method.
    }

    public function getCacheNameList() : array
    {
        // TODO: Implement getCacheNameList() method.
    }

    public function destroyCache(string $name) : void
    {
        // TODO: Implement destroyCache() method.
    }

    public function close() : void
    {
        // TODO: Implement close() method.
    }

    public function enableStatistics(string $cacheName, boolean $enabled) : void
    {
        // TODO: Implement enableStatistics() method.
    }

    public function isClosed() : boolean
    {
        // TODO: Implement isClosed() method.
    }

    public function isSupported(string $feature) : boolean
    {
        // TODO: Implement isSupported() method.
    }
}