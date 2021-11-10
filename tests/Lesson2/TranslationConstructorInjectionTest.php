<?php

namespace Test\Lesson2;

use App\Lesson2\IConfig;
use App\Lesson2\TranslationMethodInjection;
use PHPUnit\Framework\TestCase;

class TranslationConstructorInjectionTest extends TestCase
{
    public function test_hello_tw(): void
    {
        // Arrange
        $configStub = $this->createStub(IConfig::class);
        $configStub->method('get')->willReturn('tw');
        $translation = new TranslationMethodInjection($configStub);

        // Act
        $result = $translation->t('hello');

        // Assert
        self::assertEquals('哈囉', $result);
    }

    public function test_hello_jp(): void
    {
        // Arrange
        $configStub = $this->createStub(IConfig::class);
        $configStub->method('get')->willReturn('jp');
        $translation = new TranslationMethodInjection($configStub);

        // Act
        $result = $translation->t('hello');

        // Assert
        self::assertEquals('ハロー', $result);
    }
}
