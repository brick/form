<?php

declare(strict_types=1);

namespace Brick\Form\Group;

use Brick\Form\Group;
use Brick\Form\Element\Input\Checkbox;

/**
 * Represents a group of checkboxes.
 */
class CheckboxGroup extends Group
{
    /**
     * The checkboxes in the group.
     *
     * @var Checkbox[]
     */
    private $checkboxes = [];

    /**
     * Adds a checkbox to this group and returns it.
     *
     * @return Checkbox
     */
    public function addCheckbox() : Checkbox
    {
        $checkbox = new Checkbox($this->form, $this->name . '[]');
        $this->checkboxes[] = $checkbox;

        return $checkbox;
    }

    /**
     * @param array $values
     *
     * @return CheckboxGroup
     */
    public function setValues(array $values) : CheckboxGroup
    {
        foreach ($this->checkboxes as $checkbox) {
            $checkbox->setChecked(in_array($checkbox->getValue(), $values, true));
        }

        return $this;
    }

    /**
     * @todo Now that getValue() is part of the Component interface, this method should be deprecated? Or kept as alias?
     *
     * @return array
     */
    public function getValues() : array
    {
        $values = [];

        foreach ($this->checkboxes as $checkbox) {
            if ($checkbox->isChecked()) {
                $values[] = $checkbox->getValue();
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
     * @return Checkbox[]
     */
    public function getElements() : array
    {
        return $this->checkboxes;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $this->setValues($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function isArray() : bool
    {
        return true;
    }
}
