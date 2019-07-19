<?php

namespace App\Service\Mapper;

use App\Service\Dto\PageDto;
use App\Service\Dto\PaginatedDto;
use App\Service\Dto\UserDto;
use App\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserMapper
{
    public function toModel(UserDto $dto): User
    {
        $user = new User();
        $user->name = $dto->getName();
        $user->email = $dto->getEmail();
        $user->password = Hash::make($dto->getPassword());
        $user->birthday = $dto->getBirthday();
        $user->address = $dto->getAddress();

        return $user;
    }

    public function toDto(User $model): UserDto
    {
        $dto = new UserDto();
        $dto->setId($model->id);
        $dto->setName($model->name);
        $dto->setEmail($model->email);
        $dto->setBirthday($model->birthday);
        $dto->setCreatedAt($model->created_at);
        $dto->setUpdatedAt($model->updated_at);
        $dto->setAddress($model->address);

        return $dto;
    }

    public function toCollection(array $models)
    {
        $self = $this;
        $callback = function (User $model) use ($self) {
                return $self->toDto($model);
            };

        return array_map($callback, $models);
    }

    public function toPaginated(LengthAwarePaginator $paginator): PaginatedDto {
        $dto = new PaginatedDto();

        $dto->setData($this->toCollection($paginator->items()));

        $dto->setPage(new PageDto(
            $paginator->total(),
            $paginator->perPage(),
            $paginator->currentPage(),
            $paginator->previousPageUrl(),
            $paginator->nextPageUrl()
        ));

        return $dto;
    }
}