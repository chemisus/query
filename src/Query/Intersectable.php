<?php

namespace Query;

use Traversable;

interface Intersectable
{

    /**
     * @param Traversable $left
     * @param Traversable $right
     *
     * @return array
     */
    public function intersect(Traversable $left, Traversable $right);
}