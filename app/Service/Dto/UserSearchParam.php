<?php

namespace App\Service\Dto;

use Carbon\Carbon;

class UserSearchParam implements \JsonSerializable
{
    use ArrayableMembers;

    private $name;
    private $email;
    private $bornAfter;
    private $bornBefore;
    private $page;
    private $size;
    private $sortRule;

    public function __construct(
        string $name = null,
        string $email = null,
        Carbon $bornAfter = null,
        Carbon $bornBefore = null,
        int $page = null,
        int $size = null,
        array $sortRule = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->bornAfter = $bornAfter;
        $this->bornBefore = $bornBefore;
        $this->page = $page;
        $this->size = $size;
        $this->sortRule = $sortRule;
    }

    public function __toString()
    {
        return json_encode($this->jsonSerialize());
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getBornAfter()
    {
        return $this->bornAfter;
    }

    public function getBornBefore()
    {
        return $this->bornBefore;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getSortRule()
    {
        return $this->sortRule;
    }
}