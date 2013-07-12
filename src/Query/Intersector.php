<?php

namespace Query;

use Traversable;

class Intersector implements Intersectable
{

    /**
     * @param Traversable $left
     * @param Traversable $right
     *
     * @return array
     */
    public function intersect(Traversable $left, Traversable $right)
    {
        $results = [];

        foreach ($left as $a) {
            foreach ($right as $b) {
                if ($a === $b) {
                    $results[] = $a;
                }
            }
        }

        return $results;
    }
}
