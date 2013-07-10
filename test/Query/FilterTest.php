<?php

namespace Test\Query;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use Query\Filter;

class FilterTest extends PHPUnit_Framework_TestCase
{

    public function testFilter()
    {
        $array   = [1, 2, 3];
        $expect  = [1, 2 => 3];
        $filter = new Filter();

        $actual = $filter->filter(
            new ArrayIterator($array),
            function ($value) {
                return $value % 2;
            }
        );

        $this->assertEquals($expect, $actual);
    }
}
