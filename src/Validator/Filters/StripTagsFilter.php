<?php

namespace FormValidator\Validator\Filters;

class StripTagsFilter extends AbstractFilter implements Filter
{
    public function run($value)
    {
        if (is_string($value))
            $this->model->setAttribute($this->params[0], strip_tags($value));
    }
}