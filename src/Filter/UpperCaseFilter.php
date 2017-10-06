<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Converts a string to uppercase.
 */
class UpperCaseFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter(string $value) : string
    {
        return strtoupper($value);
    }
}
