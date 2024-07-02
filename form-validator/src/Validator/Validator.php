<?php
namespace FormValidator\Validator;

interface Validator
{
    public function process(array $params);
}