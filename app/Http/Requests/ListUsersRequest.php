<?php

namespace App\Http\Requests;

use App\Service\Dto\SortRule;
use App\Service\Dto\UserSearchParam;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ListUsersRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'born_after' => 'date',
            'born_before' => 'date'
        ];
    }

    public function toUserSearchParam()
    {
        $sortRule = [];
        $sortRule[] = new SortRule('created_at', 'desc');
        $sortRule[] = new SortRule('updated_at', 'desc');

        return new UserSearchParam(
            $this->get('name'),
            $this->get('email'),
            $this->has('born_after') ? Carbon::parse($this->get('born_after')) : null,
            $this->has('born_before') ? Carbon::parse($this->get('born_before')) : null,
            $this->get('page'),
            $this->get('size'),
            $sortRule,
            $this->get('address')
        );
    }
}
