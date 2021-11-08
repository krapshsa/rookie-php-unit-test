<?php

namespace App\Lesson3;

interface IRepository
{
    public function get(string $key): ?string;

    public function set(string $key, string $value);
}