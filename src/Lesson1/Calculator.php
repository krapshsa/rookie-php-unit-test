<?php

namespace App\Lesson1;

use Exception;

class Calculator
{
    /**
     * @param int $num1
     * @param int $num2
     * @return int
     * @throws Exception
     */
    public function add(int $num1, int $num2): int
    {
        $result = $num1 + $num2;
        if ($result > 2147483647) {
            throw new Exception('int32: overflow');
        }
        return $result;
    }
}