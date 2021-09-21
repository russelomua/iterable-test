<?php

namespace IterableTest;

class TransformerTest
{
    public function run(TestCase $testCase, TransformerInterface $transformer): void
    {
        $currentIndex = null;
        $currentName = [];
        $currentWeight = null;

        $isContentInvalid = false;

        $iterable = $transformer->getIterable();
        foreach ($iterable as $index => $value) {
            if (0 === $index || 0 === $index % 18) {
                if ($currentIndex > 0) {
                    $isContentInvalid = $isContentInvalid || !self::assertTrue(1 === ((int) $value - $currentIndex),
                            'Index');
                }
                $currentIndex = (int) $value;
            }
            if (1 === $index || 0 === ($index - 1) % 18) {
                $currentWeight = $value;
            }
            if (2 === $index || 0 === ($index - 2) % 18) {
                $currentName = [$value];
            }
            if (4 === $index || 0 === ($index - 4) % 18) {
                $currentName[] = $value;
            }
            if (6 === $index || 0 === ($index - 6) % 18) {
                $isContentInvalid = $isContentInvalid
                    || !self::assertTrue($value === implode('.', $currentName) . '@yopmail.com', 'Email ' . $value);
            }
            if (12 === $index || 0 === ($index - 12) % 18) {
                $isContentInvalid = $isContentInvalid
                    || !self::assertTrue(strncmp($value, $currentWeight, strlen($currentWeight)) === 0, 'Weight');
            }
        }

        self::assertTrue(!$isContentInvalid, 'Array content', true);
        self::assertTrue(
            $testCase->getIterableCount() === $transformer->getCount(),
            'Array length equal ' . $testCase->getIterableCount(),
            true
        );
        self::assertTrue(
            $testCase->getUsedMemory() <= $testCase->getMemoryLimit(),
            'Memory usage lower then ' . $testCase->getMemoryLimit() . 'Mb',
            true
        );

        $endTime = $testCase->getExecutionTime();
        self::assertTrue(
            $endTime < $testCase->getTimeLimit(),
            'Time less then ' . $testCase->getTimeLimit() . ' ms',
            true
        );

        echo 'Memory usage: ' . $testCase->getUsedMemory() . 'Mb, time: ' . $endTime . PHP_EOL;
    }

    private static function assertTrue(bool $isValid, string $message, bool $writeValid = false): bool
    {
        if (!$isValid || $writeValid) {
            echo (!$isValid ? "\033[31mFAIL: \033[0m" : "\033[32mOK: \033[0m") . $message . PHP_EOL;
        }

        return $isValid;
    }
}
