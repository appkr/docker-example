<?php

namespace App\Service\Dto;

trait ArrayableMembers
{
    public function toArray()
    {
        return get_object_vars($this);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }
}