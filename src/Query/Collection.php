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

    private $iterator_factory;

    public function __construct(
        $values,
        Mappable $mappable,
        Reducable $reducable,
        Filterable $filterable,
        TraversableFactory $iterator_factory
    ) {
        $this->values           = $values;
        $this->mappable         = $mappable;
        $this->reducable        = $reducable;
        $this->filterable       = $filterable;
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
            $this->iterator_factory
        );
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
        if ($this->values instanceof IteratorAggregate) {
            return $this->values->getIterator();
        }

        if ($this->values instanceof Traversable) {
            return $this->values;
        }

        return $this->iterator_factory->make($this->values);
    }
}
