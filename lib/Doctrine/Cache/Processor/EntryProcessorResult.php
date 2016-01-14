<?php

namespace Doctrine\Cache\Processor;

/**
 * A mechanism to represent and obtain the result of processing a Cache
 * entry using an EntryProcessor.
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