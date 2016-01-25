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

namespace Doctrine\Cache\Converter;

/**
 * Converts values of a specified type to and from an internal representation.
 *
 * {@link Converter}s are typically used convert cache keys and values to and from an appropriate internal
 * representation, that of which is managed by a cache.
 *
 * The internal representation is declared as mixed, since the type is typically unknown until runtime.
 *
 * @package Doctrine\Cache\Converter
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface Converter
{
    /**
     * Converts the value to an internal representation.
     *
     * @param mixed $value the value to convert
     *
     * @return mixed an internal representation of the value
     */
    public function toInternal(mixed $value) : mixed;

    /**
     * Converts an internal representation of a value to a value.
     *
     * @param mixed $internal the internal representation of the value
     *
     * @return mixed the value
     */
    public function fromInternal(mixed $internal) : mixed;
}