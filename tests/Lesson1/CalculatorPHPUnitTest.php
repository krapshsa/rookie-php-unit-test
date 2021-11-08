<?php

namespace Test\Lesson1;

use App\Lesson1\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorPHPUnitTest extends TestCase
{
    public function test_sum_1_plus_1_equal_2(): void
    {
        // Arrange
        $calculator = new Calculator();

        // Act
        $result = $calculator->add(1, 1);

        // Assert
        self::assertEquals(2, $result);
    }

    public function test_sum_2147483647_plus_1_raise_exception(): void
    {
        // Assert
        $this->expectException(\Exception::class);

        // Act
        $calculator = new Calculator();

        // Arrange
        $calculator->add(2147483647, 1);
    }
}
