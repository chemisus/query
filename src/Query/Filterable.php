<?php

namespace Query;

use Traversable;

interface Filterable
{
    public function filter(Traversable $array, callable $callback);
}
