<?php

namespace Test\Query;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use Query\Intersector;
use Query\Reducer;

class IntersectorTest extends PHPUnit_Framework_TestCase
{

    public function testIntersect()
    {
        $left = [1, 2, 3];
        $right = [2, 3, 4];

        $expect  = [2, 3];
        $reducer = new Intersector();

        $actual = $reducer->intersect(
            new ArrayIterator($left),
            new ArrayIterator($right)
        );

        $this->assertEquals($expect, $actual);
    }
}
