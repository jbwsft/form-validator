<?php

namespace FormValidator\Validator\Rules;

class NumericRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        if (!is_numeric($value))
            return false;

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' must be a number.';
    }
}