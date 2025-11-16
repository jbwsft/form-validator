<?php

use FormValidator\Validator\Rules\EmailRule;
use PHPUnit\Framework\TestCase;

class EmailRuleTest extends TestCase
{
    public function testIn()
    {
        $rule = new EmailRule();

        $this->assertTrue($rule->validate("123@test.co"));
        $this->assertTrue($rule->validate("test@tt.ty"));
        $this->assertTrue($rule->validate('abcdefgr4@trgjkmnh.commm'));

        $this->assertFalse($rule->validate('test@tt'));
        $this->assertFalse($rule->validate('abcdefg,r4@trgjkmnh.commm'));
        $this->assertFalse($rule->validate('32423@465.7656'));
        $this->assertFalse($rule->validate('email'));
        $this->assertFalse($rule->validate('@email'));
    }
}