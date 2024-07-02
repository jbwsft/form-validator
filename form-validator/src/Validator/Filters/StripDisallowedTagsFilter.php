<?php

namespace FormValidator\Validator\Filters;

class StripDisallowedTagsFilter extends AbstractFilter implements Filter
{
    public function run($value)
    {
        if (is_string($value))
            $this->model->setAttribute($this->params[0], strip_tags($value, $this->getAllowedTags()));
    }

    public function getAllowedTags()
    {
        return "<h1><h2><h3><h4><h5><h6><del><dd><dl><dt><pre><strong><b><br><em><hr><i><li><ol><p><s><span><table><tr><td><u><ul><div><a><blockquote><code><cite><q>";
    }
}