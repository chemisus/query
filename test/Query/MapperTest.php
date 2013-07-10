<?php

namespace Test\Query;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use Query\Mapper;

class MapperTest extends PHPUnit_Framework_TestCase
{

    public function testMap()
    {
        $array = [1, 2, 3];
        $expect = [2, 4, 6];
        $mapper = new Mapper();

        $actual = $mapper->map(
            new ArrayIterator($array),
            function ($value) {
                return $value * 2;
            }
        );

        $this->assertEquals($expect, $actual);
    }
}
