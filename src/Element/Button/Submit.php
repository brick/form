<?php

declare(strict_types=1);

namespace Brick\Form\Element\Button;

use Brick\Form\Attribute\FormAttributes;
use Brick\Form\Element;

/**
 * Represents a submit button element.
 */
class Submit extends Element\Button
{
    use FormAttributes;

    /**
     * @var bool
     */
    private $pressed = false;

    /**
     * Returns whether this submit button has been pressed to submit the form.
     *
     * This is useful for forms with multiple submit buttons.
     *
     * @return bool
     */
    public function isPressed() : bool
    {
        return $this->pressed;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $this->pressed = ($value === $this->getValue());
    }

    /**
     * {@inheritdoc}
     */
    protected function getType() : string
    {
        return 'submit';
    }
}
