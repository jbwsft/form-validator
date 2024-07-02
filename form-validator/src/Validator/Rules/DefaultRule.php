<?php

namespace FormValidator\Validator\Rules;

use FormValidator\Model;

class DefaultRule extends AbstractRule implements Rule
{
    /** @var Model $model */
    private $model;

    private $params;

    public function __construct(Model $model, $params)
    {
        $this->model = $model;

        if (!isset($params['value']))
            throw new \Exception('You must add key "value".');

        $this->params = $params;
    }

    public function validate($value)
    {
        $attrName = $this->params[0];

        if (empty($this->model->getAttribute($attrName)))
            $this->model->setAttribute($attrName, $this->params['value']);

        return true;
    }
}