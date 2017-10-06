<?php

namespace Brick\Form\Attribute;

use Brick\Form\Component;
use Brick\Html\Tag;
use Brick\Validation\Validator;

/**
 * Enforces the presence of an HTML tag.
 */
trait AbstractTag
{
    /**
     * @return Tag
     */
    abstract protected function getTag() : Tag;

    /**
     * @param \Brick\Validation\Validator $validator
     *
     * @return static
     */
    abstract protected function addValidator(Validator $validator) : Component;

    /**
     * @param string $className
     *
     * @return static
     */
    abstract protected function removeValidators(string $className) : Component;
}
