<?php

use FormValidator\Model;
use FormValidator\Validator\Rules\StringRule;
use PHPUnit\Framework\TestCase;

class StringRuleTest extends TestCase
{
    protected function getModelMock()
    {
        $stub = $this->getMockBuilder(Model::class)
            ->disableOriginalConstructor()
            ->getMock();
        $stub->method('setAttribute');

        return $stub;
    }

    public function testIsString()
    {
        $rule = new StringRule($this->getModelMock(), ['attrName']);

        $this->assertTrue($rule->validate(''));
        $this->assertTrue($rule->validate('trytryrrt'));
        $this->assertFalse($rule->validate(111));
        $this->assertFalse($rule->validate([]));
        $this->assertFalse($rule->validate(true));
        $this->assertFalse($rule->validate(false));
        $this->assertFalse($rule->validate(null));
        $this->assertFalse($rule->validate(new StdClass));
    }

    /** @dataProvider generatorLength */
    public function testLength($length, $correctValue, $wrongValue)
    {
        $rule = new StringRule($this->getModelMock(), ['attrName', 'length' => $length]);

        $this->assertTrue($rule->validate($correctValue));
        $this->assertFalse($rule->validate($wrongValue));
    }

    /** @dataProvider generatorMaxLength */
    public function testMaxLength($maxLength, $correctValue, $wrongValue)
    {
        $rule = new StringRule($this->getModelMock(), ['attrName', 'maxLength' => $maxLength]);

        $this->assertTrue($rule->validate($correctValue));
        $this->assertFalse($rule->validate($wrongValue));
    }

    /** @dataProvider generatorMinLength */
    public function testMinLength($minLength, $correctValue, $wrongValue)
    {
        $rule = new StringRule($this->getModelMock(), ['attrName', 'minLength' => $minLength]);

        $this->assertTrue($rule->validate($correctValue));
        $this->assertFalse($rule->validate($wrongValue));
    }

    /** @return Generator */
    public function generatorLength()
    {
        yield [1, 'e', 'erw'];
        yield [3, 'ere', 'erwt'];
        yield [5, 'ereoo', 'erwt'];
        yield [10, 'ereooytyyy', 'erwtjgjhghjjhgjiu'];
    }

    /** @return Generator */
    public function generatorMaxLength()
    {
        yield [1, 'e', 'erw'];
        yield [3, 'ere', 'erwt'];
        yield [5, 'ere', 'erwtttt'];
        yield [10, 'ereooytyyy', 'erwtjgjhghjjhgjiu'];
    }

    /** @return Generator */
    public function generatorMinLength()
    {
        yield [1, 'e', ''];
        yield [3, 'ere', 'er'];
        yield [5, 'ere9898j', 'erwt'];
        yield [10, 'ereooytyyy', 'e'];
    }
}