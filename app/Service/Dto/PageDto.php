<?php

namespace App\Service\Dto;

class PageDto implements \JsonSerializable, Arrayable
{
    use ArrayableMembers;

    private $total;
    private $perPage;
    private $currentPage;
    private $prev;
    private $next;

    public function __construct(
        int $total = null,
        int $perPage = null,
        int $currentPage = null,
        string $prev = null,
        string $next = null
    ) {
        $this->total = $total;
        $this->perPage = $perPage;
        $this->currentPage = $currentPage;
        $this->prev = $prev;
        $this->next = $next;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal(int $total)
    {
        $this->total = $total;
    }

    public function getPerPage()
    {
        return $this->perPage;
    }

    public function setPerPage(int $perPage)
    {
        $this->perPage = $perPage;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage)
    {
        $this->currentPage = $currentPage;
    }

    public function getPrev()
    {
        return $this->prev;
    }

    public function setPrev(?string $prev)
    {
        $this->prev = $prev;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function setNext(?string $next)
    {
        $this->next = $next;
    }
}