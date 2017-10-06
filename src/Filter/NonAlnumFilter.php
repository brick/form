<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Removes non (ASCII) alphanumeric characters.
 */
class NonAlnumFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter(string $value) : string
    {
        return preg_replace('/[^0-9a-zA-Z]/', '', $value);
    }
}
