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

/**
 * Properties class represents a persistent set of properties.
 *
 * @package Doctrine\Cache\Configuration
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class Properties implements \ArrayAccess
{
    /**
     * @var array
     */
    private $data;

    /**
     * Constructor.
     *
     * @param Properties $properties Optional default properties
     */
    public function __construct(Properties $properties = null)
    {
        $this->data = $properties ? $properties->all() : [];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->get($offset, null);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->set($offset, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * Retrieve the list of all defined properties and its corresponding values.
     *
     * @return array
     */
    public function all() : array
    {
        return $this->data;
    }

    /**
     * Return a list of all defined properties in this list.
     *
     * @return array
     */
    public function names() : array
    {
        return array_keys($this->data);
    }

    /**
     * Retrieve a property value given its name.
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function get($name, $default = null) : mixed
    {
        return $this->has($name)
            ? $this->data[$name]
            : $default;
    }

    /**
     * Define a property given its name and value.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Check if property exists in this list.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has($name) : bool
    {
        return isset($this->data[$name]) || array_key_exists($name, $this->data);
    }

    /**
     * Remove a property from the list.
     *
     * @param string $name
     */
    public function remove($name)
    {
        unset($this->data[$name]);
    }
}
