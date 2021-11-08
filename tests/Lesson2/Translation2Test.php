<?php

namespace Test\Lesson2;

use App\Lesson2\IConfig;
use App\Lesson2\Translation2;
use PHPUnit\Framework\TestCase;

class TestTranslation extends Translation2
{
    private IConfig $configStub;

    // $config 是 private 的，所以不能只增加 setConfig()
    protected function getConfig(): IConfig
    {
        return $this->configStub;
    }
    public function setConfig(IConfig $configStub): void
    {
        $this->configStub = $configStub;
    }
}

class Translation2Test extends TestCase
{
    public function test_hello_tw(): void
    {
        $translation = $this->getTranslation('tw');
        $result = $translation->t('hello');
        self::assertEquals('哈囉', $result);
    }

    public function test_hello_jp(): void
    {
        $translation = $this->getTranslation('jp');
        $result = $translation->t('hello');
        self::assertEquals('ハロー', $result);
    }

    /**
     * @param string $l10n
     * @return TestTranslation
     */
    private function getTranslation(string $l10n): TestTranslation
    {
        $configStub = $this->createStub(IConfig::class);
        $configStub->method('get')->willReturn($l10n);
        $translation = new TestTranslation();
        $translation->setConfig($configStub);
        return $translation;
    }
}
