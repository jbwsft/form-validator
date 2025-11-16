<?php

namespace FormValidator\Validator\Rules;

use FormValidator\HttpCode;
use FormValidator\Model;

abstract class AbstractRule
{
    private $defaultMessage;

    public function prepareAttrName($attr)
    {
        return ucfirst(str_replace('_', ' ', $attr));
    }

    public function getDefaultMessage($attr)
    {
        if ($this->defaultMessage === null)
            return $this->prepareAttrName($attr).' is invalid.';

        return $this->defaultMessage;
    }

    public function getDefaultStatusCode()
    {
        return HttpCode::UNPROCESSABLE_ENTITY;
    }

    public function setDefaultMessage($message)
    {
        $this->defaultMessage = $message;
        return $this;
    }

    public function isNeedValidation($value, $rule)
    {
        if ($rule != Model::RULE_REQUIRED && $value === null)
            return false;

        return true;
    }
}