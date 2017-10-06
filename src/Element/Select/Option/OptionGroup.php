<?php

namespace Brick\Form\Element\Select\Option;

use Brick\Html\Tag;

/**
 * Represents an option group inside a select element.
 */
class OptionGroup extends OptionOrGroup
{
    /**
     * The HTML tag used to render this OptionGroup.
     *
     * @var Tag
     */
    private $tag;

    /**
     * The options inside this OptionGroup.
     *
     * @var Option[]
     */
    private $options = [];

    /**
     * Class constructor.
     *
     * @param string $label The option group label.
     */
    public function __construct(string $label)
    {
        $this->tag = new Tag('optgroup', [
            'label' => $label
        ]);
    }

    /**
     * Adds an option to this OptionGroup.
     *
     * @param string $content The text content of this option.
     * @param string $value   The value of this option.
     *
     * @return static
     */
    public function addOption(string $content, string $value)
    {
        $this->options[] = new Option($content, $value);

        return $this;
    }

    /**
     * Adds a batch of options to this OptionGroup.
     *
     * @param array $options The options as key-value pairs.
     *
     * @return OptionGroup
     */
    public function addOptions(array $options) : OptionGroup
    {
        foreach ($options as $value => $content) {
            $this->addOption($content, $value);
        }

        return $this;
    }

    /**
     * Returns the options in this OptionGroup.
     *
     * @return Option[]
     */
    public function getOptions() : array
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function render() : string
    {
        $content = '';

        foreach ($this->options as $option) {
            $content .= $option->render();
        }

        return $this->tag->setHtmlContent($content)->render();
    }
}
