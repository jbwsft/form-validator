<?php
namespace src\Validator;

use src\Model;
use src\Validator\Filters\Filter;
use src\Validator\Filters\NormalizePhoneNumber;
use src\Validator\Filters\StripDisallowedTagsFilter;
use src\Validator\Filters\StripTagsFilter;
use src\Validator\Filters\TrimFilter;
use src\Validator\Rules\ArrayRule;
use src\Validator\Rules\CustomRule;
use src\Validator\Rules\DefaultRule;
use src\Validator\Rules\EmailRule;
use src\Validator\Rules\InRule;
use src\Validator\Rules\IntegerRule;
use src\Validator\Rules\NumericRule;
use src\Validator\Rules\PhoneNumberRule;
use src\Validator\Rules\RequiredRule;
use src\Validator\Rules\Rule;
use src\Validator\Rules\StringRule;

class ModelRuleFactory
{
    /**
     * @param array $params
     * @param Model $model
     * @return Rule|Filter
     * @throws \Exception
     */
    public static function create(array $params, Model $model)
    {
        switch ($params[1]) {

            case Model::RULE_REQUIRED:
                return new RequiredRule();

            case Model::RULE_CUSTOM:
                return new CustomRule($model, $params['method']);

            case Model::RULE_IN:
                return new InRule($params['values']);

            case Model::RULE_EMAIL:
                return new EmailRule();

            case Model::RULE_INTEGER:
                return new IntegerRule($params);

            case Model::RULE_NUMERIC:
                return new NumericRule();

            case Model::RULE_STRING:
                return new StringRule($model, $params);

            case Model::RULE_DEFAULT:
                return new DefaultRule($model, $params);

            case Model::RULE_ARRAY:
                return new ArrayRule();

            case Model::RULE_PHONE_NUMBER:
                return new PhoneNumberRule();

            case Model::FILTER_TRIM:
                return new TrimFilter($model, $params);

            case Model::FILTER_STRIP_TAGS:
                return new StripTagsFilter($model, $params);

            case Model::FILTER_STRIP_DISALLOWED_TAGS:
                return new StripDisallowedTagsFilter($model, $params);

            case Model::FILTER_NORMALIZE_PHONE_NUMBER:
                return new NormalizePhoneNumber($model, $params);
        }

        throw new \Exception('Rule or filter were not found.');
    }
}