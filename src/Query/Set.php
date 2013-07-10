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
     * @return array
     */
    public function get();
}