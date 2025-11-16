<?php

namespace FormValidator\Validator\Rules;

class ArrayRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        if (!is_array($value))
            return false;

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' must be an array.';
    }
}