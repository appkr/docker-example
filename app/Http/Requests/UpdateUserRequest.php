<?php

namespace App\Http\Requests;

use App\Service\Dto\UserDto;

class UpdateUserRequest extends AbstractRequest
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

    public function getDtoClass()
    {
        return new UserDto();
    }
}
