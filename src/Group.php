<?php

namespace Brick\Form;

/**
 * Represents a group of form elements.
 */
abstract class Group extends Component
{
    /**
     * @var string
     */
    protected $name;

    /**
     * {@inheritdoc}
     */
    protected function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return \Brick\Form\Element[]
     */
    abstract public function getElements();

    /**
     * Renders the elements in this group.
     *
     * The result is a simple concatenated output of all elements in the group, in the order they have been registered.
     *
     * @return string
     */
    public function __toString()
    {
        $output = '';

        foreach ($this->getElements() as $element) {
            $output .= (string) $element;
        }

        return $output;
    }
}
