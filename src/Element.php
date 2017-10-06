<?php

namespace Brick\Form;
use Brick\Html\Tag;

/**
 * Base class for form elements.
 */
abstract class Element extends Component
{
    /**
     * @var Label|null
     */
    private $label;

    /**
     * @return string
     */
    public function getId() : string
    {
        $tag = $this->getTag();

        if (! $tag->hasAttribute('id')) {
            $id = $this->form->generateElementId($this);
            $tag->setAttribute('id', $id);
        }

        return $tag->getAttribute('id');
    }

    /**
     * @todo not all elements have a required attribute. This should probably be moved to a trait.
     *
     * {@inheritdoc}
     */
    public function setRequired(bool $required) : Component
    {
        if ($required) {
            $this->getTag()->setAttribute('required', 'required');
        } else {
            $this->getTag()->removeAttribute('required');
        }

        return parent::setRequired($required);
    }

    /**
     * @param bool $disabled
     *
     * @return static
     */
    public function setDisabled(bool $disabled) : Element
    {
        if ($disabled) {
            $this->getTag()->setAttribute('disabled', 'disabled');
        } else {
            $this->getTag()->removeAttribute('disabled');
        }

        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled() : bool
    {
        return $this->getTag()->hasAttribute('disabled');
    }

    /**
     * {@inheritdoc}
     */
    protected function setName(string $name) : void
    {
        $this->getTag()->setAttribute('name', $name);
    }

    /**
     * {@inheritdoc}
     */
    public function getName() : string
    {
        return $this->getTag()->getAttribute('name');
    }

    /**
     * @todo sanity check: should not be used for 'required', 'disabled', etc.
     *
     * @param string $name
     * @param string $value
     *
     * @return static
     */
    public function setAttribute(string $name, string $value) : Element
    {
        $this->getTag()->setAttribute($name, $value);

        return $this;
    }

    /**
     * @return Label
     */
    public function getLabel() : Label
    {
        if ($this->label === null) {
            $this->label = new Label($this);
        }

        return $this->label;
    }

    /**
     * Convenience method to set the text content of the element's label.
     *
     * @param string $label
     *
     * @return static
     */
    public function setLabel(string $label) : Element
    {
        $this->getLabel()->setTextContent($label);

        return $this;
    }

    /**
     * Returns the HTML tag of this element.
     *
     * @return Tag
     */
    abstract protected function getTag() : Tag;

    /**
     * Renders the element.
     *
     * If the element doesn't have an id, one is automatically assigned.
     *
     * @return string
     */
    public function render() : string
    {
        $this->getId();
        $this->onBeforeRender();

        return $this->getTag()->render();
    }

    /**
     * Called before the HTML tag is rendered.
     *
     * @return void
     */
    protected function onBeforeRender() : void
    {
    }

    /**
     * Convenience magic method to render the element.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->render();
    }
}
