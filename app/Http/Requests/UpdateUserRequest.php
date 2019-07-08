<?php

namespace App\Http\Requests;

use App\Service\Dto\UserDto;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'birthday' => 'date'
        ];
    }

    public function toUserDto()
    {
        $dto = new UserDto();
        $dto->setName($this->get("name"));
        if ($this->has("birthday")) {
            Carbon::parse($this->get('birthday'));
        }

        return $dto;
    }
}
