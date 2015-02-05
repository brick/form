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
     * @var \Brick\Form\Element\Input\Text[]
     */
    private $inputs = [];

    /**
     * Adds a text input to this group and returns it.
     *
     * @return \Brick\Form\Element\Input\Text
     */
    public function addInputText()
    {
        $input = new Input\Text($this->form, $this->name . '[]');
        $this->inputs[] = $input;

        return $input;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        $values = [];

        foreach ($this->inputs as $input) {
            $values[] = $input->getValue();
        }

        return $values;
    }

    /**
     * @return \Brick\Form\Element\Input\Text[]
     */
    public function getElements()
    {
        return $this->inputs;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($values)
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
    protected function isArray()
    {
        return true;
    }
}
