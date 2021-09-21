<?php

use IterableTest\ArrayTransformer;
use IterableTest\TestCase;
use IterableTest\TransformerTest;

include __DIR__ . '/../vendor/autoload.php';

$case = new TestCase(__DIR__ . '/levelOne.csv', 3000);
$test = new TransformerTest();

$case->start();

// Replace ArrayTransformer by own realisation
$transformer = new ArrayTransformer($case->getFilename());

$test->run($case, $transformer);

