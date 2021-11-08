<?php

namespace Test\Lesson3;

use App\Lesson3\IRepository;
use App\Lesson3\Settings;
use PHPUnit\Framework\TestCase;

class SettingsMockTest extends TestCase
{
    private const TEST_VALUE = 'something_value';
    private const TEST_KEY   = 'something_key';
    public Settings $settings;
    public $redisMock;
    public $mysqlMock;

    // will be called before every test method
    protected function setUp(): void
    {
        // Arrange
        $this->redisMock = $this->createMock(IRepository::class);
        $this->mysqlMock = $this->createMock(IRepository::class);
        $this->settings  = new Settings($this->redisMock, $this->mysqlMock);
    }

    public function test_cache_hit(): void
    {
        // Assert
        $this->redisMock->method('get')
            ->willReturn(self::TEST_VALUE);
        $this->redisMock->expects(self::never())
            ->method('set');

        $this->mysqlMock->expects(self::never())
            ->method('get');

        // Act
        $this->settings->get(self::TEST_KEY);
    }

    public function test_cache_miss(): void
    {
        // Assert
        $this->redisMock->expects(self::once())
            ->method('get')
            ->willReturn(null);
        $this->redisMock->expects(self::once())
            ->method('set')
            ->with(self::TEST_KEY, self::TEST_VALUE);

        $this->mysqlMock->expects(self::once())
            ->method('get')
            ->willReturn(self::TEST_VALUE);

        // Act
        $this->settings->get(self::TEST_KEY);
    }

}
