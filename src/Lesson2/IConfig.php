<?php

namespace App\Lesson2;

interface IConfig
{
    function get(string $key): string;
}