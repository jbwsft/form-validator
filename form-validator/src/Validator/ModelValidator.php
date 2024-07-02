<?php
namespace FormValidator\Validator;

use FormValidator\Model;
use FormValidator\Validator\Filters\Filter;

class ModelValidator implements Validator
{
    /** @var Model $model */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function process(array $params)
    {
        $attr = $params[0];
        $value = $this->model->getAttribute($attr);

        $rule = ModelRuleFactory::create($params, $this->model);

        if ($rule instanceof Filter) {
            $rule->run($value);
        } elseif ($rule->isNeedValidation($value, $params[1]) && !$rule->validate($value)) {
            $message = isset($params['message']) ? $params['message'] : $rule->getDefaultMessage($attr);
            $statusCode = isset($params['status_code']) ? $params['status_code'] : $rule->getDefaultStatusCode();
            $this->model->addErrorByAttribute($attr, $message, $statusCode);
        }
    }
}