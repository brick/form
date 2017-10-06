<?php

declare(strict_types=1);

namespace Brick\Form\Attribute;

/**
 * Provides the autocomplete attribute to inputs.
 */
trait AutocompleteAttribute
{
    use IsElement;

    /**
     * @param string $autocomplete
     *
     * @return static
     */
    public function setAutocomplete(string $autocomplete)
    {
        $this->getTag()->setAttribute('autocomplete', $autocomplete);

        return $this;
    }
}
