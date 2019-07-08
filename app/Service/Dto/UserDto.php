<?php

namespace App\Service\Dto;

use DateTime;

class UserDto implements \JsonSerializable, Arrayable
{
    use ArrayableMembers;

    private $id;
    private $name;
    private $email;
    private $password;
    private $birthday;
    private $createdAt;
    private $updatedAt;

    public function __construct(
        int $id = null,
        string $name = null,
        string $email = null,
        string $password = null,
        DateTime $birthday = null,
        DateTime $createdAt = null,
        DateTime $updatedAt = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray()
    {
        unset($this->password);
        return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday(DateTime $birthday)
    {
        $this->birthday = $birthday;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}