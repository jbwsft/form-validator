<?php

use FormValidator\Validator\Rules\NumericRule;
use PHPUnit\Framework\TestCase;

class NumericRuleTest extends TestCase
{
    public function testIsNumeric()
    {
        $rule = new NumericRule();

        $this->assertTrue($rule->validate('12'));
        $this->assertTrue($rule->validate('0012'));
        $this->assertTrue($rule->validate(12));
        $this->assertTrue($rule->validate(012));
        $this->assertTrue($rule->validate(-12));
        $this->assertTrue($rule->validate(0));
        $this->assertTrue($rule->validate(9.09));
        $this->assertTrue($rule->validate("9.09"));

        $this->assertFalse($rule->validate("9F"));
        $this->assertFalse($rule->validate("RT"));
        $this->assertFalse($rule->validate(""));
        $this->assertFalse($rule->validate(true));
        $this->assertFalse($rule->validate(false));
        $this->assertFalse($rule->validate([]));
        $this->assertFalse($rule->validate(null));
    }
}