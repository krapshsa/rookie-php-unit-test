<?php

namespace App\Lesson2;

class Translation3
{
    /**
     * @var string[][]
     */
    private array $l10nMap = [
        'tw' => ['hello' => '哈囉'],
        'jp' => ['hello' => 'ハロー']
    ];
    private string $l10n;

    // Bad implement, just for example
    // Indirect input l10n here, want to test indirect input
    public function __construct(IConfig $config)
    {
        $this->l10n = $config->get('l10n');
    }

    public function getL10N(): string
    {
        return $this->l10n;
    }

    public function t(string $msg): string
    {
        if (
            array_key_exists($this->l10n, $this->l10nMap) &&
            array_key_exists($msg, $this->l10nMap[$this->l10n])
        ) {
            return $this->l10nMap[$this->l10n][$msg];
        }

        return $msg;
    }
}