<?php

namespace App\Service;

use App\Service\Dto\UserDto;
use Illuminate\Database\ConnectionInterface;

class TransactionalUserService implements UserService
{
    use Decoratable;

    private $delegate;
    private $connection;

    public function __construct($delegate, ConnectionInterface $connection)
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

    public function updateUser(int $userId, UserDto $dto)
    {
        $self = $this;
        return $this->connection->transaction(function () use ($self, $userId, $dto) {
            return $self->delegate->updateUser($userId, $dto);
        });
    }
}