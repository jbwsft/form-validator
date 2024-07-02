<?php

namespace FormValidator\Validator\Filters;

use FormValidator\Model;

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