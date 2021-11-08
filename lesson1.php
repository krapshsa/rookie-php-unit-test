<?php

require_once __DIR__ . '/vendor/autoload.php';

use Test\Lesson1\CalculatorTest;

function runTest(): array
{
    $testCnt = 0;
    $passCnt = 0;

    $calculatorTest = new CalculatorTest();

    $methods = get_class_methods($calculatorTest);
    foreach ($methods as $method) {
        if (0 === strpos($method, 'test_')) {
            $testCnt++;
            if ($calculatorTest->$method()) {
                $passCnt++;
            }
        }
    }

    return [$passCnt, $testCnt];
}

[$passCnt, $testCnt] = runTest();
echo "$passCnt / $testCnt" . PHP_EOL;


