<?php

namespace Test\Lesson2;

use App\Lesson2\IConfig;
use App\Lesson2\TranslationSeam;
use PHPUnit\Framework\TestCase;

class TestTranslationSeamL10N extends TranslationSeam
{
    private string  $l10n;

    protected function getL10N(): string
    {
        return $this->l10n;
    }

    public function setL10N(string $l10n)
    {
        $this->l10n = $l10n;
    }
}

class TranslationSeamL10NTest extends TestCase
{
    public function test_hello_tw_with_setL10N(): void
    {
        $translation = new TestTranslationSeamL10N();
        $translation->setL10N('tw');

        $result = $translation->t('hello');

        self::assertEquals('哈囉', $result);
    }

    public function test_hello_jp_with_setL10N(): void
    {
        $translation = new TestTranslationSeamL10N();
        $translation->setL10N('jp');

        $result = $translation->t('hello');

        self::assertEquals('ハロー', $result);
    }
}
