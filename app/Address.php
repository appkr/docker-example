<?php

namespace App;

use App\Service\Dto\Arrayable;
use App\Service\Dto\ArrayableMembers;

class Address implements \JsonSerializable, Arrayable
{
    use ArrayableMembers;

    private $siDo;
    private $siGunGu;
    private $dongRi;
    private $isMountain;
    private $jibunNumber;
    private $roadName;
    private $isBasement;
    private $buildingNumber;
    private $detail;
    private $point;

    public function __construct(
        string $siDo = null,
        string $siGunGu = null,
        string $dongRi = null,
        bool $isMountain = null,
        string $jibunNo = null,
        string $roadName = null,
        int $isBasement = null,
        string $buildingNumber = null,
        string $detail = null,
        Point $point
    ) {
        $this->siDo = $siDo;
        $this->siGunGu = $siGunGu;
        $this->dongRi = $dongRi;
        $this->isMountain = $isMountain;
        $this->jibunNumber = $jibunNo;
        $this->roadName = $roadName;
        $this->isBasement = $isBasement;
        $this->buildingNumber = $buildingNumber;
        $this->detail = $detail;
        $this->point = $point;
    }

    public function equals(Address $that)
    {
        return $this->siDo == $that->getSiDo()
            && $this->siGunGu == $that->getSiGunGu()
            && $this->dongRi == $that->getDongRi()
            && $this->isMountain == $that->isMountain()
            && $this->jibunNumber == $that->getJibunNumber()
            && $this->roadName == $that->getRoadName()
            && $this->isBasement == $that->getIsBasement()
            && $this->buildingNumber == $that->getBuildingNumber()
            && $this->detail == $that->getDetail();
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }

    public function getJibunAddress()
    {
        $mountainStr = $this->isMountain ? "산" : null;

        return implode(" ", array_filter([
            $this->siDo,
            $this->siGunGu,
            $this->dongRi,
            $mountainStr,
            $this->jibunNumber,
            $this->detail]
        ));
    }

    public function getRoadAddress()
    {
        $basementStr = $this->isBasement == 1 ? "지하" : null;

        return implode(" ", array_filter([
            $this->siDo,
            $this->siGunGu,
            $this->roadName,
            $basementStr,
            $this->buildingNumber,
            $this->detail]
        ));
    }

    public function getSiDo()
    {
        return $this->siDo;
    }

    public function setSiDo(string $siDo)
    {
        $this->siDo = $siDo;
    }

    public function getSiGunGu()
    {
        return $this->siGunGu;
    }

    public function setSiGunGu(string $siGunGu)
    {
        $this->siGunGu = $siGunGu;
    }

    public function getDongRi()
    {
        return $this->dongRi;
    }

    public function setDongRi(string $dongRi)
    {
        $this->dongRi = $dongRi;
    }

    public function isMountain()
    {
        return $this->isMountain;
    }

    public function setIsMountain(bool $isMountain)
    {
        $this->isMountain = $isMountain;
    }

    public function getJibunNumber()
    {
        return $this->jibunNumber;
    }

    public function setJibunNumber(string $jibunNumber)
    {
        $this->jibunNumber = $jibunNumber;
    }

    public function getRoadName()
    {
        return $this->roadName;
    }

    public function setRoadName(string $roadName)
    {
        $this->roadName = $roadName;
    }

    public function getIsBasement()
    {
        return $this->isBasement;
    }

    public function setIsBasement(int $isBasement)
    {
        $this->isBasement = $isBasement;
    }

    public function getBuildingNumber()
    {
        return $this->buildingNumber;
    }

    public function setBuildingNumber(string $buildingNumber)
    {
        $this->buildingNumber = $buildingNumber;
    }

    public function getDetail()
    {
        return $this->detail;
    }

    public function setDetail(string $detail)
    {
        $this->detail = $detail;
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint(Point $point)
    {
        $this->point = $point;
    }
}