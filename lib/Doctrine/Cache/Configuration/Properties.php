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
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
class Properties
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
        $this->data = $properties
            ? $properties->data
            : array();
    }

    /**
     * Retrieve a property value given its name.
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getProperty($name, $default = null)
    {
        return isset($this->data[$name])
            ? $this->data[$name]
            : $default;
    }

    /**
     * Define a property given its name and value.
     *
     * @param string $name
     * @param mixed  $value
     */
    public function setProperty($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * Check if property exists in this list.
     *
     * @param string $name
     *
     * @return boolean
     */
    public function hasProperty($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * Return a list of all defined properties in this list.
     *
     * @return array
     */
    public function propertyNames()
    {
        return array_keys($this->data);
    }
}
