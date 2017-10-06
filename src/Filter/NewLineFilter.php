<?php

declare(strict_types=1);

namespace Brick\Form\Filter;

/**
 * Filters out new lines in a string.
 */
class NewLineFilter implements Filter
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
     * {@inheritdoc}
     */
    public function filter(string $value) : string
    {
        return str_replace(["\r\n", "\r", "\n"], $this->replaceWith, $value);
    }
}
