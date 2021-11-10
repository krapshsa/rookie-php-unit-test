<?php

namespace App\Lesson2;

class TranslationMethodInjection
{
    /**
     * @var string[][]
     */
    private array $l10nMap = [
        'tw' => ['hello' => '哈囉'],
        'jp' => ['hello' => 'ハロー']
    ];
    private IConfig $config;

    public function __construct()
    {
        $this->config = new Config();
    }

    public function setConfig(IConfig $config)
    {
        $this->config = $config;
    }

    public function t(string $msg): string
    {
        $l10n = $this->config->get('l10n');

        if (
            array_key_exists($l10n, $this->l10nMap) &&
            array_key_exists($msg, $this->l10nMap[$l10n])
        ) {
            return $this->l10nMap[$l10n][$msg];
        }

        return $msg;
    }
}