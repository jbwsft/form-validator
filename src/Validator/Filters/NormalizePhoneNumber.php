<?php
namespace FormValidator\Validator\Filters;

class NormalizePhoneNumber extends AbstractFilter implements Filter
{
    public function run($value)
    {
        $value = preg_replace("/(\(|\)|\+|-|\s)/", "", $value);

        $this->model->setAttribute($this->params[0], $value);
    }
}