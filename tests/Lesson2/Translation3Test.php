<?php

namespace Test\Lesson2;

use App\Lesson2\IConfig;
use App\Lesson2\Translation3;
use PHPUnit\Framework\TestCase;

class Translation3Test extends TestCase
{
    public function test_indirect_input(): void
    {
        // Arrange
        $configStub = $this->createStub(IConfig::class);
        $configStub->method('get')->willReturn('tw');

        // Act
        $translation3 = new Translation3($configStub);

        // Assert
        self::assertEquals('tw', $translation3->getL10N());
    }
}
