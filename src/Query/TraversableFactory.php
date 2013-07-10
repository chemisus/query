<?php

namespace Query;

interface TraversableFactory
{

    /**
     * @param array $values
     *
     * @return Traversable
     */
    public function make(array $values);
}
