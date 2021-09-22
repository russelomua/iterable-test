<?php

namespace IterableTest;

class MysteryAlgorithm
{
    /**
     * @return \Traversable|iterable
     */
    public static function transform(array $row): iterable
    {
        $inner = explode(' ', $row[6]);
        foreach ($row as $i => $value) {
            yield $value;
            yield $inner[$i] ?? 'test';
        }
    }
}
