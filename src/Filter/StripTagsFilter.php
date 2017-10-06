<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Strips HTML and PHP tags from a string.
 */
class StripTagsFilter implements Filter
{
    /**
     * {@inheritdoc}
     */
    public function filter(string $value) : string
    {
        return strip_tags($value);
    }
}
