<?php

namespace src\Validator\Filters;

use src\Model;

class AbstractFilter
{
    protected $model;
    protected $params;

    public function __construct(Model $model, $params)
    {
        $this->model = $model;
        $this->params = $params;
    }
}