<?php

declare(strict_types=1);

namespace Brick\Form\Element;

use Brick\Form\Element;
use Brick\Html\Tag;

/**
 * Represents an input element.
 */
abstract class Input extends Element
{
    // @todo autofocus, disabled, form attributes

    /**
     * @var Tag|null
     */
    private $tag = null;

    /**
     * {@inheritdoc}
     */
    protected function getTag() : Tag
    {
        if ($this->tag === null) {
            $this->tag = new Tag('input', [
                'type' => $this->getType()
            ]);
        }

        return $this->tag;
    }

    /**
     * Returns the type of this input.
     *
     * @return string
     */
    abstract protected function getType() : string;
}
