<?php

namespace Brick\Form\Group;

use Brick\Form\Component;
use Brick\Form\Group;
use Brick\Form\Element\Input\Radio;

/**
 * Represents a group of radio buttons.
 */
class RadioGroup extends Group
{
    /**
     * The radio buttons in the group.
     *
     * @var Radio[]
     */
    private $radios = [];

    /**
     * Adds a radio button in this group and returns it.
     *
     * @return Radio
     */
    public function addRadio() : Radio
    {
        $radio = new Radio($this->form, $this->name);
        $radio->setRequired($this->isRequired());
        $this->radios[] = $radio;

        return $radio;
    }

    /**
     * @inheritdoc
     */
    public function setRequired(bool $required) : Component
    {
        foreach ($this->radios as $radio) {
            $radio->setRequired($required);
        }

        return parent::setRequired($required);
    }

    /**
     * @param string $value
     *
     * @return RadioGroup
     */
    public function setValue(string $value) : RadioGroup
    {
        foreach ($this->radios as $radioButton) {
            $radioButton->setChecked($radioButton->getValue() === $value);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue() : ?string
    {
        foreach ($this->radios as $radioButton) {
            if ($radioButton->isChecked()) {
                return $radioButton->getValue();
            }
        }

        return null;
    }

    /**
     * @return Radio[]
     */
    public function getElements() : array
    {
        return $this->radios;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $this->setValue($value);
    }
}
