<?php

namespace Test\Query;

use PHPUnit_Framework_TestCase;
use Query\ArrayTraversableFactory;

class ArrayTraversableFactoryTest extends PHPUnit_Framework_TestCase
{

    public function testMake()
    {
        $values = [];

        $factory = new ArrayTraversableFactory();

        $actual = $factory->make($values);

        $this->assertInstanceOf('ArrayIterator', $actual);
    }
}
