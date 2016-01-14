<?php

namespace Doctrine\Cache\Converter;

interface Converter
{
    public function toInternal(mixed $value) : mixed;

    public function fromInternal(mixed $internal) : mixed;
}