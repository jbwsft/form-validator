<?php
namespace FormValidator\Validator\Rules;

class RequiredRule extends AbstractRule implements Rule
{
    public function validate($value)
    {
        if (is_string($value))
            $value = trim($value);

        if ($value === null || $value === '' || $value === [])
            return false;

        return true;
    }

    public function getDefaultMessage($attr)
    {
        return $this->prepareAttrName($attr).' cannot be blank.';
    }
}