<?php
use PHPUnit\Framework\TestCase;
use FormValidator\CustomForm;

class FormTest extends TestCase
{
    /** @dataProvider generatorCreateForm */
    public function testCreateForm($attributes, $exist)
    {
        $form = new CustomForm($attributes);
        $diff = array_diff(array_keys($attributes), array_keys($form->getAttributes()));

        if ($exist)
            $this->assertTrue(empty($diff));
        else
            $this->assertFalse(empty($diff));
    }

    /** @return Generator */
    public function generatorCreateForm()
    {
        yield [['notExist' => null], false];
        yield [['test2' => 1], false];
        yield [['field1' => 1], true];
        yield [['field2' => 1], true];
    }
}