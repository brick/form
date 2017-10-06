<?php

declare(strict_types=1);

namespace Brick\Form\Element\Select\Option;

use Brick\Html\Tag;

/**
 * Represents an option inside a select element.
 */
class Option extends OptionOrGroup
{
    /**
     * @var Tag
     */
    private $tag;

    /**
     * @var string
     */
    private $content;

    /**
     * Class constructor.
     *
     * @param string $content The text content of this option.
     * @param string $value   The value of this option.
     */
    public function __construct(string $content, string $value)
    {
        $this->tag = new Tag('option', [
            'value' => $value
        ]);

        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->tag->getAttribute('value');
    }

    /**
     * @return bool
     */
    public function isSelected() : bool
    {
        return $this->tag->hasAttribute('selected');
    }

    /**
     * @param bool $selected Whether to select (true) or unselect (false) this option.
     *
     * @return Option
     */
    public function setSelected(bool $selected) : Option
    {
        if ($selected) {
            $this->tag->setAttribute('selected', 'selected');
        } else {
            $this->tag->removeAttribute('selected');
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function render() : string
    {
        return $this->tag->setTextContent($this->content)->render();
    }
}
