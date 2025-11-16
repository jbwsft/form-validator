<?php

use FormValidator\Validator\Rules\PhoneNumberRule;
use PHPUnit\Framework\TestCase;

class PhoneNumberRuleTest extends TestCase
{
    public function testIsPhoneNumber()
    {
        $rule = new PhoneNumberRule();

        $this->assertTrue($rule->validate('+980999999999'));
        $this->assertTrue($rule->validate('+38 099 9999999'));
        $this->assertTrue($rule->validate('+78(099)9999999'));
        $this->assertTrue($rule->validate('+58(099)99-99-999'));
        $this->assertTrue($rule->validate('99-99-999'));
        $this->assertTrue($rule->validate('1234567'));
        $this->assertTrue($rule->validate('123456789012345'));

        $this->assertFalse($rule->validate('phonenumber'));
        $this->assertFalse($rule->validate('+9809999999990000'));
        $this->assertFalse($rule->validate('123456'));
        $this->assertFalse($rule->validate('32132.13'));
        $this->assertFalse($rule->validate('32132,13'));
    }
}