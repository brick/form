<?php

namespace Brick\Form\Filter;

/**
 * Trims whitespaces around a string.
 */
class TrimFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter(string $value) : string
    {
        return trim($value);
    }
}
