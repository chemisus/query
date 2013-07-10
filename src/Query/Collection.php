<?php

namespace Query;

use IteratorAggregate;
use Traversable;

class Collection implements Set, IteratorAggregate
{

    private $values;

    private $mappable;

    private $reducable;

    private $filterable;

    private $joinable;

    private $iterator_factory;

    public function __construct(
        $values,
        Mappable $mappable,
        Reducable $reducable,
        Filterable $filterable,
        Joinable $joinable,
        TraversableFactory $iterator_factory
    ) {
        $this->values           = $values;
        $this->mappable         = $mappable;
        $this->reducable        = $reducable;
        $this->filterable       = $filterable;
        $this->joinable         = $joinable;
        $this->iterator_factory = $iterator_factory;
    }

    /**
     * @param callable $callback
     *
     * @return Set
     */
    public function map(callable $callback)
    {
        return new Collection(
            $this->mappable->map($this->getIterator(), $callback),
            $this->mappable,
            $this->reducable,
            $this->filterable,
            $this->joinable,
            $this->iterator_factory
        );
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Traversable</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        return $this->makeIterator($this->values);
    }

    public function makeIterator($array)
    {
        if ($array instanceof IteratorAggregate) {
            return $array->getIterator();
        }

        if ($array instanceof Traversable) {
            return $array;
        }

        return $this->iterator_factory->make($array);
    }

    /**
     * @param          $initial
     * @param callable $callback
     *
     * @return mixed
     */
    public function reduce($initial, callable $callback)
    {
        return $this->reducable->reduce($initial, $this->getIterator(), $callback);
    }

    /**
     * @param callable $callback
     *
     * @return Set
     */
    public function filter(callable $callback)
    {
        return new Collection(
            $this->filterable->filter($this->getIterator(), $callback),
            $this->mappable,
            $this->reducable,
            $this->filterable,
            $this->joinable,
            $this->iterator_factory
        );
    }

    /**
     * @param callable $callback
     *
     * @return Set
     */
    public function join($array, callable $filter, callable $map)
    {
        return new Collection(
            $this->joinable->join(
                $this->getIterator(),
                $this->makeIterator($array),
                $filter,
                $map
            ),
            $this->mappable,
            $this->reducable,
            $this->filterable,
            $this->joinable,
            $this->iterator_factory
        );
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->values;
    }
}
