<?php

namespace App\Console\Commands;

use App\Service\Dto\UserDto;
use App\Service\UserService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    protected $signature = 'users:create';
    protected $description = 'Create a user';

    public function handle(UserService $userService)
    {
        $dto = new UserDto();
        $dto->setName($this->getUsername());
        $dto->setEmail($this->getEmail());
        $dto->setPassword($this->getPassword());
        $dto->setBirthday($this->getBirthday());

        $dto = $userService->createUser($dto);

        $this->comment("새 사용자를 등록했습니다");
        $this->comment(json_encode($dto, JSON_PRETTY_PRINT));
    }

    private function getUsername()
    {
        $name = $this->ask('성함을 입력해주세요');
        if (mb_strlen($name) <= 2) {
            $this->warn("제출하신 성함이 유효하지 않습니다");
            return $this->getName();
        }

        return $name;
    }

    private function getEmail()
    {
        $email = $this->ask('이메일을 입력해주세요');
        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->warn('제출하신 이메일이 유효하지 않습니다');
            return $this->getEmail();
        }

        return $email;
    }

    private function getPassword()
    {
        $password = $this->secret('비밀번호를 입력해주세요 (6글자 이상)');
        if (mb_strlen($password) < 6) {
            $this->warn('제출하신 비밀번호가 유효하지 않습니다');
            return $this->getPassword();
        }

        return $password;
    }

    private function getBirthday()
    {
        $birthday = $this->ask('생년월일을 입력해주세요');
        try {
            $Ymd = Carbon::parse($birthday);
        } catch (\Exception $e) {
            return $this->getBirthday();
        }

        return $Ymd;
    }
}
