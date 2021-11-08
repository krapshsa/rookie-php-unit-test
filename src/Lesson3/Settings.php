<?php

namespace App\Lesson3;

class Settings
{
    private IRepository $redis;
    private IRepository $mysql;

    public function __construct(IRepository $redis, IRepository $mysql)
    {
        $this->redis = $redis;
        $this->mysql = $mysql;
    }

    public function get(string $key): ?string
    {
        $value = $this->redis->get($key);
        if (null === $value) {
            $value = $this->mysql->get($key);
            if (null !== $value) {
                $this->redis->set($key, $value);
            }
        }
        return $value;
    }
}