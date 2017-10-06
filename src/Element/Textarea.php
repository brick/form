<?php

namespace Brick\Form\Element;

use Brick\Form\Element;
use Brick\Form\Attribute\MaxLengthAttribute;
use Brick\Html\Tag;

/**
 * Represents a textarea element.
 */
class Textarea extends Element
{
    use MaxLengthAttribute;

    /**
     * @var Tag|null
     */
    private $tag = null;

    /**
     * The textarea contents.
     *
     * @var string
     */
    private $value = '';

    /**
     * {@inheritdoc}
     */
    protected function getTag() : Tag
    {
        if ($this->tag === null) {
            $this->tag = new Tag('textarea');
        }

        return $this->tag;
    }

    /**
     * @param string $value
     *
     * @return Textarea
     */
    public function setValue(string $value) : Textarea
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return bool
     */
    public function hasValue() : bool
    {
        $value = $this->getTag()->getAttribute('value');

        return $value !== null && $value !== '';
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getValueOrNull() : ?string
    {
        return $this->value === '' ? null : $this->value;
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $this->setValue($value);
    }

    /**
     * {@inheritdoc}
     */
    protected function onBeforeRender() : void
    {
        $this->getTag()->setTextContent($this->value);
    }
}
