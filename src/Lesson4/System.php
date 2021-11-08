<?php

namespace App\Lesson4;

class System
{
    private int $n;
    private bool $b;
    private string $s;

    public function __construct(int $n, bool $b, string $s)
    {
        $this->n = $n;
        $this->b = $b;
        $this->s = $s;
        echo "Init !" . PHP_EOL;
    }

    private function privatePlus(int $num): int
    {
        return $num + 1;
    }

    public function publicPlus(int $num): int
    {
        return $this->privatePlus($num);
    }

    protected function protectedNonGate(bool $input): bool
    {
        return !$input;
    }

    public function publicNonGate(bool $input): bool
    {
        return $this->protectedNonGate($input);
    }

    public function publicConcat(string $s1, string $s2): string
    {
        return $s1 . $s2;
    }
}