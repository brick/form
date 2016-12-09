<?php

namespace Brick\Form\Filter;

/**
 * Strips HTML and PHP tags from a string.
 */
class StripTagsFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        return strip_tags($value);
    }
}
