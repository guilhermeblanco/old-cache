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
 * An invocable function that allows applications to perform compound operations
 * on a Entry atomically, according the defined consistency of a Cache.
 *
 * AnyEntry mutations will not take effect until after the
 * EntryProcessor#process(MutableEntry, mixed...) method has completed execution.
 *
 * If an exception is thrown by an EntryProcessor, an implementation must wrap any
 * Exception thrown wrapped in an EntryProcessorException. If this occurs no mutations
 * will be made to the Entry.
 *
 * Entry access, via a call to Entry.getValue(), will behave as if Cache.get(string) was
 * called for the key. This includes updating necessary statistics, consulting the
 * configured ExpiryPolicy and loading from a configured CacheLoader.
 *
 * Entry mutation, via a call to MutableEntry.setValue(mixed), will behave as if
 * Cache.set(string, mixed) was called for the key. This includes updating necessary
 * statistics, consulting the configured ExpiryPolicy and writing to a configured CacheWriter.
 *
 * Entry removal, via a call to MutableEntry.remove(), will behave as if Cache.remove(string)
 * was called for the key. This includes updating necessary statistics and causing a delete
 * on a configured CacheWriter.
 *
 * @package Doctrine\Cache\Processor
 *
 * @author Guilherme Blanco <guilhermeblanco@hotmail.com>
 */
interface EntryProcessor
{
    /**
     * Process an entry.
     *
     * @param MutableEntry $entry
     * @param mixed...     $arguments a number of arguments to the process.
     *
     * @throws EntryProcessorException If there is a failure in entry processing.
     *
     * @return EntryProcessorResult
     */
    public function process(MutableEntry $entry, ...$arguments) : EntryProcessorResult;
}