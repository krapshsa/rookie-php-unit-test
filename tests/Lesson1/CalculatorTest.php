<?php

namespace Test\Lesson1;

use App\Lesson1\Calculator;

class CalculatorTest
{
    public function test_sum_1_plus_1_equal_2()
    {
        $calculator = new Calculator();
        $result = $calculator->add(1, 1);
        return 2 === $result;
    }

    public function test_sum_2147483647_plus_1_raise_exception()
    {
        $isThrowException = false;
        $calculator = new Calculator();
        try {
            $result = $calculator->add(2147483647, 1);
        } catch (\Exception $e) {
            $isThrowException = true;
        }
        return true === $isThrowException;
    }
}
