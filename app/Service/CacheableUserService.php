<?php

namespace App\Service;

use App\Service\Dto\UserDto;
use App\Service\Dto\UserSearchParam;
use Illuminate\Contracts\Cache\Repository;

class CacheableUserService implements UserService
{
    use Decoratable;

    private $delegate;
    private $cache;

    public function __construct(UserService $delegate, Repository $cache)
    {
        $this->delegate = $delegate;
        $this->cache = $cache;
    }

    public function findUsers(UserSearchParam $param)
    {
        $cacheKey = "users." . md5($param);
        return $this->cache->remember($cacheKey, 1000, function () use ($param) {
            return $this->delegate->findUsers($param);
        });
    }
}