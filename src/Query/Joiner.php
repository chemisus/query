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
        $joins = [];

        $results = [];

        foreach ($lefts as $key => $left) {
            foreach ($rights as $right) {
                if ($filter($left, $right)) {
                    if (!isset($joins[$key])) {
                        $joins[$key] = [
                            'left' => $left,
                            'rights' => []
                        ];
                    }

                    $joins[$key]['rights'][] = $right;
                }
            }
        }

        foreach ($joins as $join) {
            $results[] = $map($join['left'], $join['rights']);
        }

        return $results;
    }
}