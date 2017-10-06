<?php

namespace Brick\Form\Group;

use Brick\Form\Group;
use Brick\Form\Element\Input;

/**
 * Represents a group of inputs.
 */
class InputGroup extends Group
{
    /**
     * The inputs in the group.
     *
     * @var Input\Text[]
     */
    private $inputs = [];

    /**
     * Adds a text input to this group and returns it.
     *
     * @return Input\Text
     */
    public function addInputText() : Input\Text
    {
        $input = new Input\Text($this->form, $this->name . '[]');
        $this->inputs[] = $input;

        return $input;
    }

    /**
     * @todo Now that getValue() is part of the Component interface, this method should be deprecated? Or kept as alias?
     *
     * @return array
     */
    public function getValues() : array
    {
        $values = [];

        foreach ($this->inputs as $input) {
            $values[] = $input->getValue();
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
     * @return \Brick\Form\Element\Input\Text[]
     */
    public function getElements() : array
    {
        return $this->inputs;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($values) : void
    {
        foreach ($values as $key => $value) {
            if (isset($this->inputs[$key])) {
                $this->inputs[$key]->setValue($value);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function isArray() : bool
    {
        return true;
    }
}
