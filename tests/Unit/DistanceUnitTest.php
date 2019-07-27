<?php

namespace Tests\Unit;

use App\DistanceUnit;
use PHPUnit\Framework\TestCase;

class DistanceUnitTest extends TestCase
{
    public function testDistanceUnitAlwaysBeSingleton()
    {
        $sut1 = DistanceUnit::METER();
        $sut2 = DistanceUnit::METER();

        echo spl_object_hash($sut1), PHP_EOL;
        echo spl_object_hash($sut2), PHP_EOL;

        $this->assertEquals($sut1, $sut2);
    }
}
