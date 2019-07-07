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
        return new UserDto(
            $this->get("name"),
            $this->get("email"),
            $this->get("password"),
            Carbon::parse($this->get("birthday"))
        );
    }
}
