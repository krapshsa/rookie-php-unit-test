<?php

namespace Test\Lesson2;

use App\Lesson2\TranslationNotTestable;
use PHPUnit\Framework\TestCase;

class TranslationNotTestableTest extends TestCase
{
    public function test_hello_tw(): void
    {
        $translation = new TranslationNotTestable();

        $result = $translation->t('hello');

        self::assertEquals('哈囉', $result);
    }

    public function test_hello_jp(): void
    {
        $translation = new TranslationNotTestable();

        $result = $translation->t('hello');

        self::assertEquals('ハロー', $result);
    }
}
