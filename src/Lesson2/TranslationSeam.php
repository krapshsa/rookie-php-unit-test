<?php

namespace App\Lesson2;

class TranslationSeam
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

    protected function getL10N(): string
    {
        return $this->getConfig()->get('l10n');
    }

    public function t(string $msg): string
    {
        $l10n = $this->getL10N();

        if (
            array_key_exists($l10n, $this->l10n) &&
            array_key_exists($msg, $this->l10n[$l10n])
        ) {
            return $this->l10n[$l10n][$msg];
        }

        return $msg;
    }
}