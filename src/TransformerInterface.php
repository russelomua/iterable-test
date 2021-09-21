<?php

namespace IterableTest;

interface TransformerInterface
{
    public function __construct(string $filename);

    public function getIterable(): iterable;

    public function getCount(): int;
}
