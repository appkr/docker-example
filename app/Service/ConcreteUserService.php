<?php

namespace App\Service;

use App\Service\Dto\SortRule;
use App\Service\Dto\UserDto;
use App\Service\Dto\UserSearchParam;
use App\Service\Mapper\UserMapper;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class ConcreteUserService implements UserService
{
    private $userMapper;

    public function __construct(UserMapper $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    public function createUser(UserDto $dto)
    {
        $user = $this->userMapper->toModel($dto);
        $user->save();

        return $this->userMapper->toDto($user);
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

        $paginator = $qb->paginate($param->getPage(), ['*'], 'page', $param->getPage());
        $dto = $this->userMapper->toPaginated($paginator);

        return $dto;
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

        return $this->userMapper->toDto($user);
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

        $address = $param->getAddress();
        if ($this->isNotEmpty($address)) {
            $qb->where(function (Builder $qb) use ($address) {
                $qb->orWhere('addr_si_do', 'like', "%{$address}%")
                    ->orWhere('addr_si_gun_gu', 'like', "%{$address}%")
                    ->orWhere('addr_dong_ri', 'like', "%{$address}%")
                    ->orWhere('addr_jibun_number', 'like', "%{$address}%")
                    ->orWhere('addr_road_name', 'like', "%{$address}%")
                    ->orWhere('addr_building_number', 'like', "%{$address}%")
                    ->orWhere('addr_detail', 'like', "%{$address}%");
            });
        }
    }

    private function applySortRule(Builder $qb, UserSearchParam $param)
    {
        /** @var SortRule[] $sortRule */
        $sortRule = $param->getSortRule();
        if (!empty($sortRule)) {
            foreach ($sortRule as $sort) {
                $qb->orderBy($sort->getSortKey(), $sort->getSortDirection());
            }
        }
    }
}