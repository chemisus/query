<?php

namespace Query;

use ArrayIterator;

class ArrayTraversableFactory implements TraversableFactory
{

    /**
     * @param array $values
     *
     * @return Traversable
     */
    public function make(array $values)
    {
        return new ArrayIterator($values);
    }
}