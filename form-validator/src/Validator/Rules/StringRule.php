<?php
namespace FormValidator\Validator\Rules;

use FormValidator\Model;

class StringRule extends AbstractRule implements Rule
{
    protected $model;
    protected $params;
    protected $maxLength;
    protected $minLength;
    protected $length;
    protected $attrName;

    public function __construct(Model $model, $params)
    {
        $this->model = $model;
        $this->params = $params;
        $this->attrName = $this->prepareAttrName($params[0]);

        if (isset($params['maxLength']) && is_int($params['maxLength']))
            $this->maxLength = $params['maxLength'];

        if (isset($params['minLength']) && is_int($params['minLength']))
            $this->minLength = $params['minLength'];

        if (isset($params['length']) && is_int($params['length']))
            $this->length = $params['length'];

        $this->setDefaultMessage($this->attrName.' must be a string.');
    }

    public function validate($value)
    {
        if(!is_string($value))
            return false;

        $value = trim($value);
        $value = strip_tags($value, $this->getAllowedTags());

        $this->model->setAttribute($this->params[0], $value);

        if ($this->maxLength !== null && strlen($value) > $this->maxLength) {
            $this->setDefaultMessage($this->attrName.' should contain at most '.$this->maxLength.' characters.');
            return false;
        }

        if ($this->minLength !== null && strlen($value) < $this->minLength) {
            $this->setDefaultMessage($this->attrName.' should contain at least '.$this->minLength.' characters.');
            return false;
        }

        if ($this->length !== null && strlen($value) !== $this->length) {
            $this->setDefaultMessage($this->attrName.' should contain '.$this->length.' characters.');
            return false;
        }

        return true;
    }

    public function getAllowedTags()
    {
        return "<h1><h2><h3><h4><h5><h6><del><dd><dl><dt><pre><strong><b><br><em><hr><i><li><ol><p><s><span><table><tr><td><u><ul><div><a><blockquote><code><cite><q>";
    }

}