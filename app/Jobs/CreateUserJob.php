<?php

namespace App\Jobs;

use App\Service\Dto\UserDto;
use App\Service\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Psr\Log\LoggerInterface;

class CreateUserJob implements ShouldQueue
{
    private $dto;

    public function __construct(UserDto $dto)
    {
        $this->dto = $dto;
    }

    public function handle(UserService $userService, LoggerInterface $log)
    {
        $log->info("사용자 등록 작업을 시작합니다", $this->dto->toArray());
        $userService->createUser($this->dto);
        $log->info("사용자 등록 작업을 마칩니다");
    }
}
