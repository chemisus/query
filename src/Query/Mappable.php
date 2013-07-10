<?php

namespace Query;

use Traversable;

interface Mappable
{
    public function map(Traversable $array, callable $callback);
}
