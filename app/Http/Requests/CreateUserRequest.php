<?php

namespace App\Http\Requests;

use App\Service\Dto\UserDto;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "birthday" => "required",
        ];
    }

    public function toUserDto()
    {
        $dto = new UserDto();
        $dto->setName($this->get("name"));
        $dto->setEmail($this->get("email"));
        $dto->setPassword($this->get("password"));
        if ($this->has("birthday")) {
            $dto->setBirthday(Carbon::parse($this->get("birthday")));
        }

        return $dto;
    }
}
