<?php

namespace App\Support;

use Illuminate\Support\Str;
use JsonSerializable;

class ToSnakeCaseArray
{
    public static function run($data)
    {
        if (empty($data)) {
            return $data;
        }
        if (is_scalar($data)) {
            return $data;
        }
        if ($data instanceof \DateTime) {
            return $data->format(\DateTime::RFC3339);
        }
        if ($data instanceof JsonSerializable && !is_array($data->jsonSerialize())) {
            return $data;
        }

        if ($data instanceof JsonSerializable && is_array($data->jsonSerialize())) {
            $data = $data->jsonSerialize();
        } elseif ($data instanceof Arrayable) {
            $data = $data->toArray();
        } elseif ($data instanceof stdClass) {
            $data = (array) $data;
        }

        if (! is_array($data)) {
            return $data;
        }

        $newData = [];
        foreach ($data as $key => $value) {
            $newKey = Str::snake($key);
            $newData[$newKey] = static::run($value);
        }

        return $newData;
    }

    public function __invoke($data)
    {
        return static::run($data);
    }
}