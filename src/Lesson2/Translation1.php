<?php

namespace App\Lesson2;

class Translation1
{
    /**
     * @var string[][]
     */
    private array $l10n = [
        'tw' => ['hello' => '哈囉'],
        'jp' => ['hello' => 'ハロー']
    ];
    private IConfig $config;

    public function __construct(?IConfig $config)
    {
        if ($config) {
            $this->config = $config;
        } else {
            $this->config = new Config();
        }
    }

    public function t(string $msg): string
    {
        $language = $this->config->get('l10n');
        if (
            array_key_exists($language, $this->l10n) &&
            array_key_exists($msg, $this->l10n[$language])
        ) {
            return $this->l10n[$language][$msg];
        }

        return $msg;
    }
}