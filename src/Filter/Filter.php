<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Interface that filters must implement.
 */
interface Filter
{
    /**
     * @param string $value The value to filter.
     *
     * @return string The filtered value.
     */
    public function filter(string $value) : string;
}
