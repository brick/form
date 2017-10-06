<?php

declare(strict_types=1);

namespace Brick\Form\Element\Button;

use Brick\Form\Element;

/**
 * Represents a button element.
 */
class Button extends Element\Button
{
    /**
     * {@inheritdoc}
     */
    protected function getType() : string
    {
        return 'button';
    }
}
