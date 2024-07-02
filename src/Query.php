<?php

namespace src;

abstract class Query extends Model
{
    abstract public function getData();

    public function getAttributesAsQueryString()
    {
        return http_build_query($this->getAttributes());
    }
}