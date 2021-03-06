<?php

namespace App\Service;

use App\Service\Dto\UserDto;
use Psr\Log\LoggerInterface;

class LoggableService implements UserService
{
    use Decoratable;

    private $delegate;
    private $logger;

    public function __construct(UserService $delegate, LoggerInterface $logger)
    {
        $this->delegate = $delegate;
        $this->logger = $logger;
    }

    public function createUser(UserDto $dto)
    {
        $this->before(__FUNCTION__, $dto);
        $res = $this->delegate->createUser($dto);
        $this->after(__FUNCTION__, $res);

        return $res;
    }

    private function before(string $funcName, ...$parameters) {
        $this->logger->info("Entering {$funcName} with parameter " . implode(",", $parameters));
    }

    private function after(string $funcName, $res) {
        $this->logger->info("Exiting {$funcName} with result " . $res ?: null);
    }
}