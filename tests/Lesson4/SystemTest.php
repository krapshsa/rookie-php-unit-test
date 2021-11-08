<?php

namespace Test\Lesson4;

use App\Lesson4\System;
use Mockery;
use PHPUnit\Framework\TestCase;

class SystemTest extends TestCase
{
    public function test_System_createStub(): void
    {
        $systemStub = $this->createStub(System::class);

        $methods = get_class_methods($systemStub);

        // test visibility
        self::assertEquals(false, in_array("privatePlus", $methods));
        self::assertEquals(false, in_array("protectedNonGate", $methods));
        self::assertEquals(true, in_array("publicPlus", $methods));
        self::assertEquals(true, in_array("publicNonGate", $methods));
        self::assertEquals(true, in_array("publicConcat", $methods));

        // test return
        self::assertEquals(0, $systemStub->publicPlus(1));
        self::assertEquals(false, $systemStub->publicNonGate(false));
        self::assertEquals("", $systemStub->publicConcat("a", "b"));
    }

    public function test_System_createMock(): void
    {
        /*
        $systemMock = $this->getMockBuilder(System::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();
        */
        $systemMock = $this->createMock(System::class);

        $methods = get_class_methods($systemMock);

        // test visibility
        self::assertEquals(false, in_array("privatePlus", $methods));
        self::assertEquals(false, in_array("protectedNonGate", $methods));
        self::assertEquals(true, in_array("publicPlus", $methods));
        self::assertEquals(true, in_array("publicNonGate", $methods));
        self::assertEquals(true, in_array("publicConcat", $methods));

        // test return
        self::assertEquals(0, $systemMock->publicPlus(1));
        self::assertEquals(false, $systemMock->publicNonGate(false));
        self::assertEquals("", $systemMock->publicConcat("a", "b"));
    }

    public function test_System_getMockBuilder(): void
    {
        $systemStub = $this->getMockBuilder(System::class)
            ->onlyMethods([])
            ->setConstructorArgs([1, true, "abc"])
            ->getMock();

        $methods = get_class_methods($systemStub);

        // test visibility
        self::assertEquals(false, in_array("privatePlus", $methods));
        self::assertEquals(false, in_array("protectedNonGate", $methods));
        self::assertEquals(true, in_array("publicPlus", $methods));
        self::assertEquals(true, in_array("publicNonGate", $methods));
        self::assertEquals(true, in_array("publicConcat", $methods));

        // test return
        self::assertEquals(2   , $systemStub->publicPlus(1));
        self::assertEquals(true, $systemStub->publicNonGate(false));
        self::assertEquals("ab", $systemStub->publicConcat("a", "b"));
    }

    public function test_System_spy(): void
    {
        $systemMock = Mockery::spy(System::class);

        $methods = get_class_methods($systemMock);

        // test visibility
        self::assertEquals(false, in_array("privatePlus", $methods));
        self::assertEquals(false, in_array("protectedNonGate", $methods));
        self::assertEquals(true, in_array("publicPlus", $methods));
        self::assertEquals(true, in_array("publicNonGate", $methods));
        self::assertEquals(true, in_array("publicConcat", $methods));

        // test return
        self::assertEquals(0, $systemMock->publicPlus(1));
        self::assertEquals(false, $systemMock->publicNonGate(false));
        self::assertEquals("", $systemMock->publicConcat("a", "b"));
    }
}
