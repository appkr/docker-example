<?php

namespace App\Service;

use App\Service\Dto\UserDto;
use App\Service\Dto\UserSearchParam;

interface UserService
{
    public function createUser(UserDto $dto);

    public function findById(int $id);

    public function findUsers(UserSearchParam $param);

    public function updateUser(int $userId, UserDto $dto);
}