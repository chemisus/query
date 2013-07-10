<?php

namespace Query;

use Traversable;

class Joiner implements Joinable
{

    /**
     * @param Traversable $lefts
     * @param Traversable $rights
     * @param callable    $filter
     * @param callable    $map
     *
     * @return array
     */
    public function join(Traversable $lefts, Traversable $rights, callable $filter, callable $map)
    {
        $results = [];

        foreach ($lefts as $left) {
            foreach ($rights as $right) {
                if ($filter($left, $right)) {
                    $results[] = $map($left, $right);
                }
            }
        }

        return $results;
    }
}