<?php

namespace App\Service;

trait Decoratable
{
    public function __call($method, $parameters)
    {
        if (property_exists($this, 'delegate')) {
            return call_user_func_array([$this->delegate, $method], $parameters);
        }

        throw new \Exception("Illegal call");
    }
}