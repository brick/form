<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Converts the first character of every word to uppercase.
 */
class UpperCaseFirstFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter(string $value) : string
    {
        return ucfirst($value);
    }
}
