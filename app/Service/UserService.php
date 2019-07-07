<?php

namespace App\Service;

use App\Service\Dto\SortRule;
use App\Service\Dto\UserDto;
use App\Service\Dto\UserSearchParam;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function createUser(UserDto $dto)
    {
        $user = new User();
        $user->name = $dto->getName();
        $user->password = Hash::make($dto->getPassword());
        $user->birthday = $dto->getBirthday();
        $user->save();
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id)
    {
        return User::find($id);
    }

    public function findUsers(UserSearchParam $param)
    {
        $qb = User::query();
        $this->applySearchParam($qb, $param);
        $this->applySortRule($qb, $param);

        return $qb->paginate($param->getPage(), ['*'], 'page', $param->getPage());
    }

    private function isNotEmpty($value)
    {
        return mb_strlen($value) > 0;
    }

    private function applySearchParam(Builder $qb, UserSearchParam $param)
    {
        $name = $param->getName();
        if ($this->isNotEmpty($name)) {
            $qb->where('name', 'like', "%{$name}%");
        }

        $email = $param->getEmail();
        if ($this->isNotEmpty($email)) {
            $qb->where('email', 'like', "%{$email}%");
        }

        $bornAfter = $param->getBornAfter();
        if ($bornAfter != null) {
            $qb->where('birthday', '>=', $bornAfter->startOfDay());
        }

        $bornBefore = $param->getBornBefore();
        if ($bornBefore != null) {
            $qb->where('birthday', "<=", $bornBefore->endOfDay());
        }
    }

    private function applySortRule(Builder $qb, UserSearchParam $param)
    {
        /** @var SortRule[] $sortRule */
        $sortRule = $param->getSortRule();
        foreach ($sortRule as $sort) {
            $qb->orderBy($sort->getSortKey(), $sort->getSortDirection());
        }
    }

    public function updateUser(int $userId, UserDto $dto)
    {
        $user = $this->findById($userId);

        $name = $dto->getName();
        if ($name != null) {
            $user->name = $name;
        }

        $birthday = $dto->getBirthday();
        if ($birthday != null) {
            $user->birthday = $birthday;
        }

        $user->save();
    }
}