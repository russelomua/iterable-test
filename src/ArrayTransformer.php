<?php

namespace IterableTest;

class ArrayTransformer implements TransformerInterface
{
    private array $data = [];

    public function __construct(string $filename)
    {
        $this->readData($filename);
    }

    private function getCsvLinesWithoutHeader(string $filename)
    {
        $string = file_get_contents($filename);
        $lines = explode(PHP_EOL, $string);
        array_shift($lines);
        return $lines;
    }

    private function readData(string $filename): void
    {
        $lines = $this->getCsvLinesWithoutHeader($filename);

        foreach ($lines as $datum) {
            $row = str_getcsv($datum);
            foreach (MysteryAlgorithm::transform($row) as $value) {
                $this->data[] = $value;
            }
        }
    }

    public function getIterable(): iterable
    {
        return $this->data;
    }

    public function getCount(): int
    {
        return count($this->data);
    }
}
