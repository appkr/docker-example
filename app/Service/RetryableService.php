<?php

namespace App\Service;

use App\Service\Dto\UserDto;
use App\Service\Dto\UserSearchParam;
use Mockery\Exception;
use Psr\Log\LoggerInterface;

class RetryableService implements UserService
{
    const MAX_RETRY = 3;
    const DELAY     = 1000;

    private $delegate;
    private $logger;
    private $count = 0;

    public function __construct(UserService $delegate, LoggerInterface $logger)
    {
        $this->delegate = $delegate;
        $this->logger = $logger;
    }

    public function createUser(UserDto $dto)
    {
        $res = null;
        try {
            $res = $this->delegate->createUser($dto);
        } catch (Exception $e) {
            $this->logger->error("Failed handling " . __METHOD__ . " at {$this->count} attempt");
            ++$this->count;
            if ($this->count >= self::MAX_RETRY) {
                throw $e;
            }
            usleep(self::DELAY);
            $this->createUser($dto);
        }

        return $res;
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
        return $this->delegate->updateUser($userId, $dto);
    }
}