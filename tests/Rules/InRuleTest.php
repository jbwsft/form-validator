<?php

use FormValidator\Validator\Rules\InRule;
use PHPUnit\Framework\TestCase;

class InRuleTest extends TestCase
{
    public function testIn()
    {
        $rule = new InRule(['123', 345, 'FRT']);

        $this->assertTrue($rule->validate("123"));
        $this->assertTrue($rule->validate(123));
        $this->assertTrue($rule->validate('345'));
        $this->assertTrue($rule->validate(345));
        $this->assertTrue($rule->validate('FRT'));

        $this->assertFalse($rule->validate('1'));
        $this->assertFalse($rule->validate('12.3'));
        $this->assertFalse($rule->validate(34));
        $this->assertFalse($rule->validate('FR'));
        $this->assertFalse($rule->validate('RT'));
    }
}