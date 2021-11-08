<?php

namespace App\Lesson2;

class TranslationNotTestable
{
    /**
     * @var string[][]
     */
    private array $l10n = [
        'tw' => ['hello' => '哈囉'],
        'jp' => ['hello' => 'ハロー']
    ];

    public function t(string $msg): string
    {
        $config = new Config();
        $language = $config->get('l10n');
        if (
            array_key_exists($language, $this->l10n) &&
            array_key_exists($msg, $this->l10n[$language])
        ) {
            return $this->l10n[$language][$msg];
        }

        return $msg;
    }
}