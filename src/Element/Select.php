<?php

declare(strict_types=1);

namespace Brick\Form\Element;

use Brick\Form\Element;
use Brick\Form\Element\Select\Option\Option;
use Brick\Form\Element\Select\Option\OptionGroup;
use Brick\Form\Element\Select\Option\OptionOrGroup;
use Brick\Html\Tag;

/**
 * Represents a select element.
 */
abstract class Select extends Element
{
    /**
     * @var Tag|null
     */
    private $tag;

    /**
     * The options and option groups in this Select.
     *
     * @var OptionOrGroup[]
     */
    protected $elements = [];

    /**
     * {@inheritdoc}
     */
    protected function getTag() : Tag
    {
        if ($this->tag === null) {
            $this->tag = new Tag('select');

            if ($this->isArray()) {
                $this->tag->setAttribute('multiple', 'multiple');
            }
        }

        return $this->tag;
    }

    /**
     * @param string $content The text content of this option.
     * @param string $value   The value of this option.
     *
     * @return Option
     */
    public function addOption(string $content, string $value) : Option
    {
        $option = new Option($content, $value);
        $this->elements[] = $option;

        return $option;
    }

    /**
     * Adds a batch of options to this Select.
     *
     * The array format is [value] => text content.
     *
     * @param array $options
     *
     * @return static
     */
    public function addOptions(array $options) : Select
    {
        foreach ($options as $value => $content) {
            $this->addOption($content, $value);
        }

        return $this;
    }

    /**
     * @param string $label The option group label.
     *
     * @return OptionGroup
     */
    public function addOptionGroup(string $label) : OptionGroup
    {
        $optionGroup = new OptionGroup($label);
        $this->elements[] = $optionGroup;

        return $optionGroup;
    }

    /**
     * Returns all the options in this Select, including the ones nested in option groups.
     *
     * @return Option[]
     */
    protected function getOptions() : array
    {
        $options = [];

        foreach ($this->elements as $element) {
            if ($element instanceof Option) {
                $options[] = $element;
            }
            elseif ($element instanceof OptionGroup) {
                $options = array_merge($options, $element->getOptions());
            }
        }

        return $options;
    }

    /**
     * {@inheritdoc}
     */
    protected function onBeforeRender() : void
    {
        $content = '';

        foreach ($this->elements as $element) {
            $content .= $element->render();
        }

        $this->getTag()->setHtmlContent($content);
    }
}
