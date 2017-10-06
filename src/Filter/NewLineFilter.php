<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Filters out new lines in a string.
 */
class NewLineFilter
{
    /**
     * @var string
     */
    private $replaceWith;

    /**
     * @param string $replaceWith
     */
    public function __construct(string $replaceWith = '')
    {
        $this->replaceWith = $replaceWith;
    }

    /**
     * @param string $value
     *
     * @return string
     */
    public function __invoke(string $value) : string
    {
        return str_replace(["\r\n", "\r", "\n"], $this->replaceWith, $value);
    }
}
