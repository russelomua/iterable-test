<?php

namespace IterableTest;

class MysteryAlgorithm
{
    public static function transform(array $row): iterable
    {
        $index = 0;
        $inner = explode(' ', $row[6]);
        foreach ($row as $i => $value) {
            yield $index => $value;
            yield $index => $inner[$i] ?? 'test';
        }
    }
}
