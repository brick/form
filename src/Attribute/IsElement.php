<?php

declare(strict_types=1);

namespace Brick\Form\Attribute;

use Brick\Form\Component;
use Brick\Html\Tag;
use Brick\Validation\Validator;

/**
 * Enforces the usage of a trait on an Element class, and provides static code analysis capabilities.
 */
trait IsElement
{
    /**
     * @return Tag
     */
    abstract protected function getTag() : Tag;

    /**
     * @param Validator $validator
     *
     * @return Component
     */
    abstract protected function addValidator(Validator $validator) : Component;

    /**
     * @param string $className
     *
     * @return Component
     */
    abstract protected function removeValidators(string $className) : Component;
}
