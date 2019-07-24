<?php

namespace App;

class Distance
{
    private $value;
    private $unit;

    private function __construct(float $value, DistanceUnit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    public static function ZERO()
    {
        return new static(0, DistanceUnit::METER());
    }

    public static function of(float $value, DistanceUnit $unit)
    {
        return new static($value, $unit);
    }

    public function in(DistanceUnit $newUnit)
    {
        if ($this->unit == $newUnit) {
            return new static($this->value, $this->unit);
        }

        return new static(
            $this->value
                * ($this->unit->getMultiplier() / $newUnit->getMultiplier()),
            $newUnit
        );
    }

    public function equals(Distance $that)
    {
        return $this->value == $that->getValue()
            && $this->unit == $that->getUnit();
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function getUnit(): DistanceUnit
    {
        return $this->unit;
    }

    public function format(int $precision)
    {
        return number_format($this->value, $precision) . $this->unit->getAbbrev();
    }
}