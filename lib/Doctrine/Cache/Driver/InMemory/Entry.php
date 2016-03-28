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

use Doctrine\Cache\string;

class Entry implements \Doctrine\Cache\Entry
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var mixed
     */
    private $oldValue;

    /**
     * Entry constructor.
     * @param string $key
     * @param mixed  $value
     * @param mixed  $oldValue
     */
    public function __construct(string $key, $value, $oldValue = null)
    {
        $this->key      = $key;
        $this->value    = $value;
        $this->oldValue = $oldValue;
    }

    /**
     * Returns the key corresponding to this entry.
     *
     * @return string
     */
    public function getKey() : string
    {
        return $this->key;
    }

    /**
     * Returns the value stored in the cache when this entry was created.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Returns the old value stored in the cache, if any.
     *
     * @return mixed
     */
    public function getOldValue()
    {
        return $this->oldValue;
    }
}