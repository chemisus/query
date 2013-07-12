<?php

namespace Test\Query;

use ArrayIterator;
use PHPUnit_Framework_TestCase;
use Query\Filter;
use Query\Query;

class QueryTest extends PHPUnit_Framework_TestCase
{

    public function testMake()
    {
        $query = new Query();

        $actual = $query->make([]);

        $this->assertInstanceOf('Query\Set', $actual);
    }
}
