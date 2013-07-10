<?php

namespace Query;

use Traversable;

class Filter implements Filterable
{

    public function filter(Traversable $array, callable $callback)
    {
        $results = [];

        foreach ($array as $key => $value) {
            if ($callback($value, $key)) {
                $results[$key] = $value;
            }
        }

        return $results;
    }
}
