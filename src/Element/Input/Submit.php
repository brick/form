<?php

namespace Brick\Form\Element\Input;

use Brick\Form\Attribute\FormAttributes;
use Brick\Form\Element\Input;
use Brick\Form\Attribute\ValueAttribute;

/**
 * Represents a submit input element.
 */
class Submit extends Input
{
    use FormAttributes;
    use ValueAttribute;

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
