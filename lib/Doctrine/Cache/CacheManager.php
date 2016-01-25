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

namespace Doctrine\Cache;

/**
 * A {@link CacheManager} provides a means of establishing, configuring, acquiring, closing and destroying uniquely
 * named {@link Cache}s.
 *
 * Implementations of CacheManager may additionally provide and share external resources between the Caches being
 * managed, for example, the content of the managed Caches may be stored in the same cluster.
 *
 * @package Doctrine\Cache
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface CacheManager
{
    public function createCache(string $name, Configuration\CacheConfiguration $configuration) : Cache;

    public function getCache(string $name) : Cache;

    public function getCacheNameList() : array;

    public function destroyCache(string $name) : void;

    public function close() : void;

    public function enableStatistics(string $cacheName, boolean $enabled) : void;

    public function isClosed() : boolean;

    public function isSupported(string $feature) : boolean;
}