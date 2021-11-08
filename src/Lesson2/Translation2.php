<?php

namespace App\Lesson2;

class Translation2
{
    /**
     * @var string[][]
     */
    private array $l10n = [
        'tw' => ['hello' => '哈囉'],
        'jp' => ['hello' => 'ハロー']
    ];
    private IConfig $config;

    public function __construct()
    {
        $this->config = new Config();
    }

    protected function getConfig(): IConfig
    {
        return $this->config;
    }

    public function t(string $msg): string
    {
        $language = $this->getConfig()->get('l10n');
        if (
            array_key_exists($language, $this->l10n) &&
            array_key_exists($msg, $this->l10n[$language])
        ) {
            return $this->l10n[$language][$msg];
        }

        return $msg;
    }
}