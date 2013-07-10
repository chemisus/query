<?php

namespace Test\Query;

use Mockery;
use PHPUnit_Framework_TestCase;
use Query\Collection;
use ArrayIterator;

class CollectionTest extends PHPUnit_Framework_TestCase
{

    private $mapper;

    private $reducer;

    private $filter;

    private $mapped;

    private $reduced;

    private $filtered;

    private $initial;

    public function setUp()
    {
        parent::setUp();

        $this->mapper           = Mockery::mock('Query\Mappable');
        $this->reducer          = Mockery::mock('Query\Reducable');
        $this->filter           = Mockery::mock('Query\Filterable');
        $this->iterator_factory = Mockery::mock('Query\TraversableFactory');
        $this->values           = [1, 2, 3];
        $this->mapped           = [2, 4, 6];
        $this->reduced          = 6;
        $this->filtered         = [3];
        $this->initial          = 0;
        $this->callback         = function () {
        };
        $this->iterator = new ArrayIterator($this->values);

        $this->collection = new Collection(
            $this->values,
            $this->mapper,
            $this->reducer,
            $this->filter,
            $this->iterator_factory
        );

        $this->mapper->shouldReceive('map')->with($this->iterator, $this->callback)->andReturn($this->mapped);

        $this->reducer->shouldReceive('reduce')->with($this->initial, $this->iterator, $this->callback)->andReturn(
            $this->reduced
        );

        $this->filter->shouldReceive('filter')->with($this->iterator, $this->callback)->andReturn($this->filtered);

        $this->iterator_factory->shouldReceive('make')->with($this->values)->andReturn($this->iterator);
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testGet()
    {
        $expect = $this->values;

        $actual = $this->collection->get();

        $this->assertEquals($expect, $actual);
    }

    public function testMap()
    {
        $expect = $this->mapped;

        $actual = $this->collection->map($this->callback)->get();

        $this->assertEquals($expect, $actual);
    }

    public function testReduce()
    {
        $expect = $this->reduced;

        $actual = $this->collection->reduce($this->initial, $this->callback);

        $this->assertEquals($expect, $actual);
    }

    public function testFilter()
    {
        $expect = $this->filtered;

        $actual = $this->collection->filter($this->callback)->get();

        $this->assertEquals($expect, $actual);
    }

    public function testGetIteratorWithIteratorAggregate()
    {
        $expect = Mockery::mock();

        $iterator_aggregate = Mockery::mock('IteratorAggregate');
        $iterator_aggregate->shouldReceive('getIterator')->andReturn($expect);

        $this->collection = new Collection(
            $iterator_aggregate,
            $this->mapper,
            $this->reducer,
            $this->filter,
            $this->iterator_factory
        );

        $actual = $this->collection->getIterator();

        $this->assertEquals($expect, $actual);
    }

    public function testGetIteratorWithIterator()
    {
        $expect = Mockery::mock('Iterator');

        $this->collection = new Collection(
            $expect,
            $this->mapper,
            $this->reducer,
            $this->filter,
            $this->iterator_factory
        );

        $actual = $this->collection->getIterator();

        $this->assertEquals($expect, $actual);
    }

    public function testGetIteratorWithArray()
    {
        $expect = $this->iterator;

        $this->collection = new Collection(
            $this->values,
            $this->mapper,
            $this->reducer,
            $this->filter,
            $this->iterator_factory
        );

        $actual = $this->collection->getIterator();

        $this->assertEquals($expect, $actual);
    }
}
