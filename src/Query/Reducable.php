<?php

namespace Query;

use Traversable;

interface Reducable
{
    public function reduce($initial, Traversable $array, callable $callback);
}
