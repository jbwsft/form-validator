<?php

namespace FormValidator\Validator\Rules;

class CustomRule extends AbstractRule implements Rule
{
    protected $baseObject;
    protected $validateMethod;

    public function __construct($baseObject, $validateMethod)
    {
        $this->baseObject = $baseObject;
        $this->validateMethod = $validateMethod;
    }

    public function validate($value)
    {
        return $this->baseObject->{$this->validateMethod}($value);
    }
}