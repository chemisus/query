<?php

namespace Query;

interface Set
{

    /**
     * @param callable $callback
     *
     * @return Set
     */
    public function map(callable $callback);

    /**
     * @param          $initial
     * @param callable $callback
     *
     * @return mixed
     */
    public function reduce($initial, callable $callback);

    /**
     * @param callable $callback
     *
     * @return Set
     */
    public function filter(callable $callback);

    /**
     * @param          $rights
     * @param callable $filter
     * @param callable $map
     *
     * @return Set
     */
    public function join($rights, callable $filter, callable $map);

    /**
     * @return array
     */
    public function get();
}