<?php
namespace src\Validator;

interface Validator
{
    public function process(array $params);
}