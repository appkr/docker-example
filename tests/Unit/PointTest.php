<?php

namespace Tests\Unit;

use Tests\TestCase;

class PointTest extends TestCase
{
    public function testCanCalculateDistanceBetweenTwoPoints()
    {
        // 서울특별시청별관
        $a = new \App\Point("126.9756535", "37.5643639");
        // 프레스티지 호텔
        $b = new \App\Point("126.9796687", "37.5648493");

        echo $a->distanceTo($b)->format(2), PHP_EOL;
        $this->assertTrue(true);
    }
}
