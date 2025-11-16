<?php
namespace FormValidator\Validator\Rules;

interface Rule
{
    /**
     * @param $value
     * @return bool
     */
    public function validate($value);

    /**
     * @param $value
     * @return bool
     */
    public function isNeedValidation($value, $rule);

    /**
     * @param string $attr
     * @return string
     */
    public function getDefaultMessage($attr);

    /**
     * @return int
     */
    public function getDefaultStatusCode();
}