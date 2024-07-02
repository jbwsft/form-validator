<?php

namespace tests\Rules;

use PHPUnit\Framework\TestCase;
use src\Validator\Rules\EmailRule;

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