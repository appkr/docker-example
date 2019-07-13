<?php

namespace App\Http\Requests;

use App\Service\Dto\UserDto;

class CreateUserRequest extends AbstractRequest
{
    public function rules()
    {
        return [
            "name" => "required",
            "email" => "required",
            "password" => "required",
            "birthday" => "required",
        ];
    }

    public function getDtoClass()
    {
        return new UserDto();
    }
}
