<?php

namespace Brick\Form\Attribute;

/**
 * Provides the autocomplete attribute to inputs.
 */
trait AutocompleteAttribute
{
    use AbstractTag;

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
