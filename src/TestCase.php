<?php

namespace IterableTest;

final class TestCase
{
    private string $filename;

    private int $memoryLimit;

    private int $timeLimit;

    private float $startTime = .0;

    private int $startMemory = 0;

    private int $dataLines;

    public function __construct(string $filename, int $dataLines)
    {
        $this->filename = $filename;
        $this->memoryLimit = (int) ceil(2 * filesize($filename) / 1024 / 1024);
        $this->timeLimit = (int) ceil($this->memoryLimit / 5);
        $this->dataLines = $dataLines;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getMemoryLimit(): int
    {
        return $this->memoryLimit;
    }

    public function getTimeLimit(): int
    {
        return $this->timeLimit;
    }

    public function getIterableCount(): int
    {
        return $this->dataLines * 9 * 2;
    }

    public function start(): void
    {
        if (!empty($this->startTime)) {
            return;
        }

        echo PHP_EOL . ' ------- ' . basename($this->filename) . ' ------- ' . PHP_EOL;

        $this->startTime = microtime(true);
        $this->startMemory = memory_get_usage(true);
    }

    public function getExecutionTime(): float
    {
        return microtime(true) - $this->startTime;
    }

    public function getUsedMemory(): float
    {
        $usedMemory = memory_get_usage(true);
        $delta = $usedMemory - $this->startMemory;

        $realUsage = 0 === $delta ? $usedMemory : $delta;

        return round($realUsage / 1024 / 1024, 2);
    }
}
