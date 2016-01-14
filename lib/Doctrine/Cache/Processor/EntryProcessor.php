<?php

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