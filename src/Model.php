<?php

namespace FormValidator;

use FormValidator\Validator\ModelValidator;

abstract class Model
{
    const RULE_REQUIRED = 'required';
    const RULE_EMAIL    = 'email';
    const RULE_INTEGER  = 'integer';
    const RULE_NUMERIC  = 'numeric';
    const RULE_IN       = 'in';
    const RULE_CUSTOM   = 'custom';
    const RULE_STRING   = 'string';
    const RULE_ARRAY    = 'array';
    const RULE_DEFAULT  = 'default';
    const RULE_PHONE_NUMBER  = 'phone_number';

    const FILTER_TRIM  = 'FILTER_TRIM';
    const FILTER_STRIP_TAGS  = 'FILTER_STRIP_TAGS';
    const FILTER_STRIP_DISALLOWED_TAGS  = 'FILTER_STRIP_DISALLOWED_TAGS';
    const FILTER_NORMALIZE_PHONE_NUMBER  = 'FILTER_NORMALIZE_PHONE_NUMBER';

    protected $attributes = [];
    protected $errors = [];
    /** @var ModelValidator $validator */
    private $validator;

    public function __construct(array $attributes)
    {
        $this->setAttributes($attributes);
        $this->validator = new ModelValidator($this);
    }

    /**
     * @param string $attr
     * @param string $error
     * @param int $statusCode
     * @return $this
     */
    public function addErrorByAttribute($attr, $error, $statusCode = HttpCode::UNPROCESSABLE_ENTITY)
    {
        if ($this->getErrorByAttribute($attr) === null)
            $this->errors[$attr] = [
                'detail' => $error,
                'status_code' => $statusCode,
            ];

        return $this;
    }

    /**
     * @param $attr
     * @return string|null
     */
    public function getErrorByAttribute($attr)
    {
        return isset($this->errors[$attr]) ? isset($this->errors[$attr]) : null;
    }

    public function hasErrorByAttribute($attr)
    {
        return $this->getErrorByAttribute($attr) !== null;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getErrorsInDefaultFormat()
    {
        $errors = $this->getErrors();
        $result = [];

        foreach ($errors as $attr => $error) {
            $result[$attr] =  isset($error['detail']) ? $error['detail'] : "";
        }

        return  $result;
    }

    public function getErrorsInSpecialFormat()
    {
        $errors = $this->getErrors();
        $result = [];

        foreach ($errors as $attr => $error) {
            $result[] = [
                "status" => isset($error['status_code']) ? $error['status_code'] : HttpCode::UNPROCESSABLE_ENTITY,
                "source" => [
                    "pointer" => $attr
                ],
                "title" =>  "Invalid Attribute",
                "detail" => isset($error['detail']) ? $error['detail'] : "",
            ];
        }

        return [
            'errors' => $result
        ];
    }

    /**
     * @return bool (false - if not errors)
     */
    public function hasErrors()
    {
        return count($this->errors) > 0;
    }

    public function setAttributes(array $attributes)
    {
        $this->attributes = array_merge($this->attributes, array_intersect_key($attributes, $this->attributes));
        return $this;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
        return $this;
    }

    public function getAttribute($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasAttribute($name)
    {
        return isset($this->attributes[$name]);
    }

    /**
     * @return bool
     */
    public function validate()
    {
        foreach ($this->rules() as $rules)
            if (!$this->hasErrorByAttribute($rules[0]))
                $this->validator->process($rules);

        return !$this->hasErrors();
    }

    abstract public function rules();
}