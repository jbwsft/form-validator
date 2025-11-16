<?php
namespace FormValidator;

class CustomForm extends Form
{
    protected $attributes = [
        'field1' => 1,
        'field2' => null,
        'field3' => null,
        'field4' => null,
        'field5' => null,
        'field6' => null,
        'field7' => null
    ];

    public function rules()
    {
        return [
            ['field1', self::FILTER_TRIM],
            ['field1', self::FILTER_STRIP_DISALLOWED_TAGS],
            ['field1', self::RULE_REQUIRED],
            ['field1', self::RULE_STRING, 'maxLength' => 100, 'minLength' => 5],
            ['field1', self::RULE_CUSTOM, 'method' => 'validateName', 'message' => 'Name is not valid!'],

            ['field1', self::FILTER_STRIP_TAGS],
            ['field2', self::RULE_REQUIRED],
            ['field2', self::FILTER_NORMALIZE_PHONE_NUMBER],
            ['field2', self::RULE_PHONE_NUMBER],

            ['field3', self::RULE_REQUIRED],
            ['field3', self::RULE_IN, 'values' => [1, 3, 5]],

            ['field3', self::RULE_REQUIRED],
            ['field4', self::RULE_ARRAY],

            ['field3', self::RULE_REQUIRED],
            ['field5', self::RULE_EMAIL],

            ['field6', self::RULE_NUMERIC],

            ['field6', self::RULE_INTEGER, 'min' => 10, 'max' => 1000],

            ['field7', self::RULE_DEFAULT, 'value' => 'myDefaultValue'],
        ];
    }
}