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

namespace Doctrine\Cache\Processor;

/**
 * A mechanism to represent and obtain the result of processing a Cache
 * entry using an EntryProcessor.
 *
 * @package Doctrine\Cache\Processor
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface EntryProcessorResult
{
    /**
     * Obtain the result of processing an entry with an EntryProcessor.
     *
     * If an exception was thrown during the processing of an entry, either
     * by the EntryProcessor itself or by the Caching implementation, the
     * exceptions will be wrapped and re-thrown as a EntryProcessorException
     * when calling this method.
     *
     * @throws CacheException          If the implementation failed to execute the EntryProcessor
     * @throws EntryProcessorException If the EntryProcessor raised an exception, this
     *                                 exception will be used to wrap the causing exception.
     *
     * @return mixed
     */
    public function get() : mixed;
}