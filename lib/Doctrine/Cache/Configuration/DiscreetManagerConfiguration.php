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

use Doctrine\Cache\Provider\CacheProvider;

/**
 * Discreet Manager Configuration, free of any bounded cache provider choices.
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class DiscreetManagerConfiguration extends Properties implements ManagerConfiguration
{
    /**
     * @var \Doctrine\Cache\Provider\CacheProvider
     */
    private $cacheProvider;

    /**
     * @var \Doctrine\Cache\Configuration\Properties
     */
    private $properties;

    /**
     * Constructor.
     *
     * @param \Doctrine\Cache\Provider\CacheProvider   $cacheProvider
     * @param \Doctrine\Cache\Configuration\Properties $properties
     */
    public function __construct(CacheProvider $cacheProvider, Properties $properties = null)
    {
        $this->cacheProvider = $cacheProvider;
        $this->properties    = $properties ?: new Properties();
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheProvider()
    {
        return $this->cacheProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties()
    {
        return $this->properties;
    }
}