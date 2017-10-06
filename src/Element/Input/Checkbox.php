<?php

namespace Brick\Form\Element\Input;

use Brick\Form\Attribute\CheckedAttribute;
use Brick\Form\Attribute\RequiredAttribute;
use Brick\Form\Attribute\ValueAttribute;
use Brick\Form\Element\Input;

/**
 * Represents a checkbox input element.
 */
class Checkbox extends Input
{
    use CheckedAttribute;
    use RequiredAttribute;
    use ValueAttribute;

    /**
     * {@inheritdoc}
     */
    protected function getType() : string
    {
        return 'checkbox';
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $thisValue = $this->getValueOrNull();

        if ($thisValue === null) {
            $thisValue = 'on';
        }

        $this->setChecked($value === $thisValue);
    }
}
