<?php

namespace Test\Lesson2;

use App\Lesson2\IConfig;
use App\Lesson2\Translation1;
use PHPUnit\Framework\TestCase;

class Translation1Test extends TestCase
{
    public function test_hello_tw(): void
    {
        // Arrange
        $translation = $this->getTranslation('tw');

        // Act
        $result = $translation->t('hello');

        // Assert
        self::assertEquals('哈囉', $result);
    }

    public function test_hello_jp(): void
    {
        // Arrange
        $translation = $this->getTranslation('jp');

        // Act
        $result = $translation->t('hello');

        // Assert
        self::assertEquals('ハロー', $result);
    }

    /**
     * @param string $l10n
     * @return Translation1
     */
    private function getTranslation(string $l10n): Translation1
    {
        $configStub = $this->createStub(IConfig::class);
        $configStub->method('get')->willReturn($l10n);
        return new Translation1($configStub);
    }
}
