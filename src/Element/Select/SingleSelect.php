<?php

namespace Brick\Form\Element\Select;

use Brick\Form\Element\Select;

/**
 * Represents a single choice select element.
 */
class SingleSelect extends Select
{
    /**
     * @param string $value
     *
     * @return SingleSelect
     */
    public function setValue(string $value) : SingleSelect
    {
        $oneSelected = false;

        foreach ($this->getOptions() as $option) {
            $thisSelected = ! $oneSelected && $option->getValue() === $value;
            $oneSelected = $oneSelected || $thisSelected;
            $option->setSelected($thisSelected);
        }

        return $this;
    }

    /**
     * Returns the selected value, or null if none is selected.
     *
     * @return string|null
     */
    public function getValue() : ?string
    {
        foreach ($this->getOptions() as $option) {
            if ($option->isSelected()) {
                return $option->getValue();
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $this->setValue($value);
    }
}
