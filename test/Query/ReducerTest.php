<?php

namespace Test\Query;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use Query\Reducer;

class ReducerTest extends PHPUnit_Framework_TestCase
{

    public function testReduce()
    {
        $initial = 0;
        $array   = [1, 2, 3];
        $expect  = 6;
        $reducer = new Reducer();

        $actual = $reducer->reduce(
            $initial,
            new ArrayIterator($array),
            function ($result, $value) {
                return $result + $value;
            }
        );

        $this->assertEquals($expect, $actual);
    }
}
