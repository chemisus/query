<?php

namespace Query;

class Query
{
    public function make($array)
    {
        return new Collection(
            $array,
            new Mapper(),
            new Reducer(),
            new Filter(),
            new Joiner(),
            new ArrayTraversableFactory()
        );
    }
}