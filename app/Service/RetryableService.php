<?php

namespace App\Service;

use App\Service\Dto\UserDto;
use Psr\Log\LoggerInterface;

class RetryableService implements UserService
{
    use Decoratable;

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
        ++$this->count;
        $res = null;
        try {
            $res = $this->delegate->createUser($dto);
            $this->logger->info("Handling " . __METHOD__ . " at {$this->count}th attempt");
        } catch (\Exception $e) {
            $this->logger->error("Failed handling " . __METHOD__ . " at {$this->count}th attempt");
            if ($this->count >= self::MAX_RETRY) {
                throw $e;
            }
            usleep(self::DELAY);
            $this->createUser($dto);
        }

        return $res;
    }
}