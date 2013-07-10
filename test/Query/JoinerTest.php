<?php

namespace Test\Query;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use Query\Joiner;

class JoinerTest extends PHPUnit_Framework_TestCase
{

    public function testJoin()
    {
        $left   = [1, 2, 3];
        $right  = [2, 3, 4];
        $expect = [9, 14, 12];

        $joiner = new Joiner();

        $actual = $joiner->join(
            new ArrayIterator($left),
            new ArrayIterator($right),
            function ($left, $right) {
                return $left < $right;
            },
            function ($left, $right) {
                return $left * array_sum($right);
            }
        );

        $this->assertEquals($expect, $actual);
    }
}
