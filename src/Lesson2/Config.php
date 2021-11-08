<?php

namespace App\Lesson2;

use function array_merge;
use function is_array;

class Config implements IConfig
{
    private array $cache = [];

    public function __construct()
    {
        $configPath = __DIR__ . '/test.php';
        if (file_exists($configPath)) {
            include $configPath;
        }

        if (isset($CONFIG) && is_array($CONFIG)) {
            $this->cache = array_merge($this->cache, $CONFIG);
        }
    }

    public function get(string $key): string
    {
        return $this->cache[$key];
    }
}