<?php

namespace Brick\Form\Element\Button;

use Brick\Form\Element;

/**
 * Represents a reset button element.
 */
class Reset extends Element\Button
{
    /**
     * {@inheritdoc}
     */
    protected function getType()
    {
        return 'reset';
    }
}
