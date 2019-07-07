<?php

namespace App\Service\Dto;

use Carbon\Carbon;

class UserDto
{
    private $name;
    private $email;
    private $password;
    private $birthday;

    public function __construct(string $name = null, string $email = null, string $password = null, Carbon $birthday = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }
}