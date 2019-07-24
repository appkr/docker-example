<?php

namespace Tests\Unit;

use App\Distance;
use App\DistanceUnit;
use Tests\TestCase;

class DistanceTest extends TestCase
{
    public function testCanCreateZeroDistance()
    {
        $sut = Distance::ZERO();

        $this->assertEquals(0, $sut->getValue());
    }

    public function testCanCreateDistanceObject()
    {
        $sut = Distance::of(100, DistanceUnit::METER());

        $this->assertInstanceOf(Distance::class, $sut);
    }

    public function testCanConvertDistanceUnit()
    {
        $original = Distance::of(100, DistanceUnit::METER());
        $converted = $original->in(DistanceUnit::KILOMETER());

        $this->assertEquals(0.1, $converted->getValue());
    }

    public function testCanConvertDistanceUnit2()
    {
        $original = Distance::of(1, DistanceUnit::KILOMETER());
        $converted = $original->in(DistanceUnit::METER());

        $this->assertEquals(1000, $converted->getValue());
    }

    public function testCanPrintDistance()
    {
        $sut1 = Distance::of(1000, DistanceUnit::METER());
        $sut2 = Distance::of(1, DistanceUnit::KILOMETER());

        $this->assertEquals("1,000.0m", $sut1->format(1));
        $this->assertEquals("1.00km", $sut2->format(2));
    }
}
