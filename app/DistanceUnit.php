<?php

namespace App;

/**
 * Class DistanceUnit
 * @package App
 *
 * @method static DistanceUnit METER()
 * @method static DistanceUnit KILOMETER()
 */
class DistanceUnit
{
    const METER = "METER";
    const KILOMETER = "KILOMETER";

    private static $singletonCache = [];

    private $value;
    private $multiplier;
    private $abbrev;

    private function __construct(string $value, int $multiplier, string $abbrev)
    {
        $this->value = $value;
        $this->multiplier = $multiplier;
        $this->abbrev = $abbrev;
    }

    public static function getInstance(string $value)
    {
        if (!in_array($value, get_defined_constants())) {
            throw new \InvalidArgumentException();
        }

        if (!array_key_exists($value, self::$singletonCache)) {
            $instance = null;
            switch ($value) {
                case self::METER:
                    $instance = new static($value, 1, "m");
                    break;
                case self::KILOMETER:
                    $instance = new static($value, 1000, "km");
                    break;
                default:
                    throw new \InvalidArgumentException();
            }
            self::$singletonCache[$value] = $instance;
        }

        return self::$singletonCache[$value];
    }

    public static function __callStatic($name, $arguments)
    {
        if (in_array($name, get_defined_constants())) {
            return self::getInstance($name);
        }
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getMultiplier()
    {
        return $this->multiplier;
    }

    public function getAbbrev()
    {
        return $this->abbrev;
    }
}
