<?php

namespace Tests\Unit;

use App\Address;
use App\Point;
use Tests\TestCase;

class AddressTest extends TestCase
{
    public function testEquals()
    {
        $sut1 = new Address(
            "서울특별시",
            "중구",
            "서소문동",
            false,
            "37",
            "덕수궁길",
            0,
            "15",
            "서울특별시청별관",
            new Point(
                "126.97565350953265",
                "126.97565350953265"
            )
        );

        $sut2 = new Address(
            "서울특별시",
            "중구",
            "서소문동",
            false,
            "37",
            "덕수궁길",
            0,
            "15",
            "서울특별시청별관",
            new Point(
                "126.97565350953265",
                "126.97565350953265"
            )
        );

        echo spl_object_hash($sut1), PHP_EOL;
        echo spl_object_hash($sut2), PHP_EOL;

        $this->assertTrue($sut1->equals($sut2));
    }
}