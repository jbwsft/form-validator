<?php

namespace tests\Rules;

use PHPUnit\Framework\TestCase;
use src\Validator\Rules\RequiredRule;

class RequiredRuleTest extends TestCase
{
    public function testIsRequired()
    {
        $rule = new RequiredRule();

        $this->assertTrue($rule->validate('      1   '));
        $this->assertTrue($rule->validate('1'));
        $this->assertTrue($rule->validate('jgjh'));
        $this->assertTrue($rule->validate(true));
        $this->assertTrue($rule->validate(false));
        $this->assertTrue($rule->validate(['element']));
        $this->assertTrue($rule->validate(new StdClass));

        $this->assertFalse($rule->validate(''));
        $this->assertFalse($rule->validate('       '));
        $this->assertFalse($rule->validate([]));
        $this->assertFalse($rule->validate(null));
    }
}