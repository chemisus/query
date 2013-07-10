<?php

namespace Query;

use Traversable;

class Mapper implements Mappable
{

    public function map(Traversable $array, callable $callback)
    {
        $results = [];

        foreach ($array as $key => $value) {
            $results[$key] = $callback($value, $key);
        }

        return $results;
    }
}