<?php

namespace Query;

use Traversable;

class Reducer implements Reducable
{

    public function reduce($initial, Traversable $array, callable $callback)
    {
        $result = $initial;

        foreach ($array as $key => $value) {
            $result = $callback($result, $value, $key);
        }

        return $result;
    }
}