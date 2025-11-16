<?php

namespace FormValidator\Validator\Rules;

class InRule extends AbstractRule implements Rule
{
    protected $neededValues;

    public function __construct(array $neededValues)
    {
        $this->neededValues = $neededValues;
    }

    public function validate($value)
    {
        if (!in_array($value, $this->neededValues))
            return false;

        return true;
    }
}