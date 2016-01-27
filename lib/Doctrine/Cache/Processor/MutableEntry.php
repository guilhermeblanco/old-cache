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

namespace Doctrine\Cache\Processor;

use Doctrine\Cache\Entry;

/**
 * A mutable representation of an Entry.
 *
 * @package Doctrine\Cache\Processor
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface MutableEntry extends Entry
{
    /**
     * Checks for the existence of the entry in the cache.
     *
     * @return bool
     */
    public function exists() : bool;

    /**
     * Removes the entry from the Cache.
     *
     * This has the same semantics as calling Cache.remove(K).
     */
    public function remove();

    /**
     * Sets or replaces the value associated with the key.
     *
     * If exists() is false and setValue is called then a mapping is added to the cache visible once the EntryProcessor
     * completes. Moreover a second invocation of exists() will return true.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    public function setValue($value);
}