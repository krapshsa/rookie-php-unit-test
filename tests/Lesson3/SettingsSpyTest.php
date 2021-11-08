<?php

namespace Test\Lesson3;

use App\Lesson3\IRepository;
use App\Lesson3\Settings;
use Mockery;
use PHPUnit\Framework\TestCase;

class SettingsSpyTest extends TestCase
{
    private const TEST_HIT_VALUE  = 'hit_value';
    private const TEST_HIT_KEY    = 'hit_key';
    private const TEST_MISS_VALUE = 'miss_value';
    private const TEST_MISS_KEY   = 'miss_key';
    public Settings $settings;
    public $redisSpy;
    public $mysqlSpy;

    // will be called before every test method
    protected function setUp(): void
    {
        // Arrange
        $this->redisSpy = Mockery::spy(IRepository::class);
        $this->redisSpy->shouldReceive('get')
            ->andReturnUsing(function ($key) {
                if (self::TEST_HIT_KEY === $key) {
                    return self::TEST_HIT_VALUE;
                }
                return null;
            });

        $this->mysqlSpy = Mockery::spy(IRepository::class);
        $this->mysqlSpy->shouldReceive('get')
            ->andReturnUsing(function ($key) {
                if (self::TEST_HIT_KEY === $key) {
                    return self::TEST_HIT_VALUE;
                }
                if (self::TEST_MISS_KEY === $key) {
                    return self::TEST_MISS_VALUE;
                }
                return null;
            });

        $this->settings  = new Settings($this->redisSpy, $this->mysqlSpy);
    }

    public function test_cache_hit(): void
    {
        // Act
        $value = $this->settings->get(self::TEST_HIT_KEY);

        // Assert
        $this->redisSpy->shouldHaveReceived('get')
            ->once()
            ->with(self::TEST_HIT_KEY);

        $this->redisSpy->shouldNotHaveReceived('set');

        $this->mysqlSpy->shouldNotHaveReceived('get');

        // must have, need an assertion in every test
        self::assertEquals(self::TEST_HIT_VALUE, $value);
    }

    public function test_cache_miss(): void
    {
        // Act
        $value = $this->settings->get(self::TEST_MISS_KEY);

        // Assert
        $this->redisSpy->shouldHaveReceived('get')
            ->once();

        $this->redisSpy->shouldHaveReceived('set')
            ->once()
            ->with(self::TEST_MISS_KEY, self::TEST_MISS_VALUE);

        $this->mysqlSpy->shouldHaveReceived('get')
            ->once()
            ->with(self::TEST_MISS_KEY);

        // must have, need an assertion in every test
        self::assertEquals(self::TEST_MISS_VALUE, $value);
    }
}
