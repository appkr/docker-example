<?php

namespace App\Service\Dto;

class SortRule
{
    private $sortKey;
    private $sortDirection;

    public function __construct($sortKey, $sortDirection)
    {
        $this->sortKey = $sortKey;
        $this->sortDirection = $sortDirection;
    }

    public function getSortKey()
    {
        return $this->sortKey;
    }

    public function getSortDirection()
    {
        return $this->sortDirection;
    }
}