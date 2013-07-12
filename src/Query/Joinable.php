<?php

namespace Query;

use Traversable;

interface Joinable
{

    /**
     * @param Traversable $left
     * @param Traversable $right
     * @param callable    $filter
     * @param callable    $mapper
     *
     * @return mixed
     */
    public function join(Traversable $left, Traversable $right, callable $filter, callable $mapper);
}
