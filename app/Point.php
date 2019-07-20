<?php

namespace App;

use App\Service\Dto\Arrayable;
use App\Service\Dto\ArrayableMembers;

class Point implements \JsonSerializable, Arrayable
{
    use ArrayableMembers;

    private $x;
    private $y;

    public function __construct(string $x = null, string $y = null)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function getX()
    {
        return $this->x;
    }

    public function setX(string $x)
    {
        $this->x = $x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function setY(string $y)
    {
        $this->y = $y;
    }

    public function distanceTo(Point $that): Distance
    {
        $distanceInMeter = acos(
                sin($this->y * M_PI / 180) * sin($that->getY() * M_PI / 180)
                + cos($this->y * M_PI / 180) * cos($that->getY() * M_PI / 180)
                * cos(($this->x - $that->getX()) * M_PI / 180)
            ) * 180 / M_PI * 60 * 1.1515 * 1.609344 * 1000;

        return Distance::of($distanceInMeter, DistanceUnit::METER());
    }
}