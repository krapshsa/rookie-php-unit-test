<?php

namespace App\Exercise;

class Config
{
    private static ?array $config;

    public static function init(): void
    {
        $filePath = __DIR__ . '/config.json';
        $data = file_get_contents($filePath);
        self::$config = \json_decode($data);
    }

    public static function getValue(string $key): ?string
    {
        return self::$config[$key] ?? null;
    }
}