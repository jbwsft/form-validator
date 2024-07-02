<?php

use FormValidator\Validator\Rules\IntegerRule;
use PHPUnit\Framework\TestCase;

class IntegerRuleTest extends TestCase
{
    public function testIsInteger()
    {
        $rule = new IntegerRule([]);

        $this->assertTrue($rule->validate(123123));
        $this->assertTrue($rule->validate('123123'));

        $this->assertFalse($rule->validate('0123123'));
        $this->assertFalse($rule->validate('123123.3'));
        $this->assertFalse($rule->validate('123123,3'));
        $this->assertFalse($rule->validate('FT'));
        $this->assertFalse($rule->validate('123FT'));
    }
}