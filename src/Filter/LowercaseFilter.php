<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Converts a string to lowercase.
 */
class LowerCaseFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter(string $value) : string
    {
        return strtolower($value);
    }
}
