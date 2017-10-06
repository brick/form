<?php

namespace Brick\Form;

use Brick\Html\Tag;

/**
 * Represents a label that targets a form element.
 */
class Label
{
    /**
     * @var Element
     */
    private $element;

    /**
     * @var Tag
     */
    private $tag;

    /**
     * Class constructor.
     *
     * @param Element $element
     */
    public function __construct(Element $element)
    {
        $this->element = $element;
        $this->tag = new Tag('label');
    }

    /**
     * Sets an attribute on the label tag.
     *
     * @param string $name
     * @param string $value
     *
     * @return Label
     */
    public function setAttribute(string $name, string $value) : Label
    {
        $this->tag->setAttribute($name, $value);

        return $this;
    }

    /**
     * Sets the text content of the label.
     *
     * @param string $text
     *
     * @return Label
     */
    public function setTextContent(string $text) : Label
    {
        $this->tag->setTextContent($text);

        return $this;
    }

    /**
     * Sets the HTML content of the label.
     *
     * @param string $html
     *
     * @return Label
     */
    public function setHtmlContent(string $html) : Label
    {
        $this->tag->setHtmlContent($html);

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty() : bool
    {
        return $this->tag->isEmpty();
    }

    /**
     * Renders the label.
     *
     * @return string
     */
    public function render() : string
    {
        return $this->tag->setAttribute('for', $this->element->getId())->render();
    }

    /**
     * Renders the opening tag.
     *
     * @return string
     */
    public function open() : string
    {
        return $this->tag->renderOpeningTag();
    }

    /**
     * Render the closing tag.
     *
     * @return string
     */
    public function close() : string
    {
        return $this->tag->renderClosingTag();
    }

    /**
     * Convenience magic method to render the label.
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->render();
    }
}
