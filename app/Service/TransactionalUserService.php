<?php

namespace App\Service;

use App\Service\Dto\UserDto;
use App\Service\Dto\UserSearchParam;
use Illuminate\Database\ConnectionInterface;

class TransactionalUserService implements UserService
{
    private $delegate;
    private $connection;

    public function __construct(UserService $delegate, ConnectionInterface $connection)
    {
        $this->delegate = $delegate;
        $this->connection = $connection;
    }

    public function createUser(UserDto $dto)
    {
        $self = $this;
        return $this->connection->transaction(function () use ($self, $dto) {
            return $self->delegate->createUser($dto);
        });
    }

    public function findById(int $id)
    {
        return $this->delegate->findById($id);
    }

    public function findUsers(UserSearchParam $param)
    {
        return $this->delegate->findUsers($param);
    }

    public function updateUser(int $userId, UserDto $dto)
    {
        $self = $this;
        return $this->connection->transaction(function () use ($self, $userId, $dto) {
            return $self->delegate->updateUser($userId, $dto);
        });
    }
}