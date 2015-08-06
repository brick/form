<?php

namespace Brick\Form\Element\Select;

use Brick\Form\Element\Select;

/**
 * Represents a multiple choice select element.
 */
class MultipleSelect extends Select
{
    /**
     * @param array $values
     *
     * @return static
     */
    public function setValues(array $values)
    {
        foreach ($this->getOptions() as $option) {
            $option->setSelected(in_array($option->getValue(), $values));
        }

        return $this;
    }

    /**
     * @todo Now that getValue() is part of the Component interface, this method should be deprecated? Or kept as alias?
     *
     * @return array
     */
    public function getValues()
    {
        $values = [];

        foreach ($this->getOptions() as $option) {
            if ($option->isSelected()) {
                $values[] = $option->getValue();
            }
        }

        return $values;
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->getValues();
    }

    /**
     * {@inheritdoc}
     */
    protected function isArray()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value)
    {
        $this->setValues($value);
    }
}
