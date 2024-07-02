<?php

use FormValidator\Validator\Rules\RequiredRule;
use PHPUnit\Framework\TestCase;

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