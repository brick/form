<?php

namespace Brick\Form\Filter;

/**
 * Converts the first character of every word to uppercase.
 */
class UpperCaseFirstFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        return ucfirst($value);
    }
}
