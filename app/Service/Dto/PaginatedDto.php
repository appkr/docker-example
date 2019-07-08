<?php

namespace App\Service\Dto;

class PaginatedDto implements \JsonSerializable, Arrayable
{
    use ArrayableMembers;

    private $data;
    private $page;

    public function __construct(
        array $data = null,
        PageDto $page = null
    ) {
        $this->data = $data;
        $this->page = $page;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPage(PageDto $page)
    {
        $this->page = $page;
    }
}