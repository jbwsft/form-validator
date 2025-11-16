<?php

namespace FormValidator\Validator\Rules;

class IntegerRule extends AbstractRule implements Rule
{
    protected $minValue;
    protected $maxValue;

    public function __construct(array $params)
    {
        if (isset($params['min']))
            $this->minValue = $params['min'];

        if (isset($params['max']))
            $this->maxValue = $params['max'];

    }

    public function validate($value)
    {
        if (filter_var($value, FILTER_VALIDATE_INT) === false)
            return false;

        if ($this->minValue !== null && $value < $this->minValue)
            return false;

        if ($this->maxValue !== null && $value > $this->maxValue)
            return false;

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' must be an integer.';
    }
}