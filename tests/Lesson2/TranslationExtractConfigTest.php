<?php

namespace Test\Lesson2;

use App\Lesson2\IConfig;
use App\Lesson2\TranslationExtract;
use PHPUnit\Framework\TestCase;

class TestTranslationExtractConfig extends TranslationExtract
{
    // 故意取不一樣名字。
    // 因為 parent 有相同的 private property
    // 如果呼叫 child 沒繼承的 method 會用到 parent 的 property
    private IConfig $configStub;

    protected function getConfig(): IConfig
    {
        return $this->configStub;
    }

    public function setConfig(IConfig $configStub): void
    {
        $this->configStub = $configStub;
    }
}

class TranslationExtractConfigTest extends TestCase
{
    public function test_hello_tw_with_setConfig(): void
    {
        $configStub = $this->createStub(IConfig::class);
        $configStub->method('get')->willReturn('tw');
        $translation = new TestTranslationExtractConfig();
        $translation->setConfig($configStub);

        $result = $translation->t('hello');

        self::assertEquals('哈囉', $result);
    }

    public function test_hello_jp_with_setConfig(): void
    {
        $configStub = $this->createStub(IConfig::class);
        $configStub->method('get')->willReturn('jp');
        $translation = new TestTranslationExtractConfig();
        $translation->setConfig($configStub);

        $result = $translation->t('hello');

        self::assertEquals('ハロー', $result);
    }
}
