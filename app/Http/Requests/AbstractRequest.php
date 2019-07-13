<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest
{
    abstract public function getDtoClass();

    public function toDto()
    {
        $mapper = new \JsonMapper();
        $json = json_decode($this->getContent());

        return $mapper->map($json, $this->getDtoClass());
    }

    public function authorize()
    {
        return true;
    }
}