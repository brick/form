<?php

namespace Brick\Form\Attribute;

/**
 * Provides the value attribute to inputs.
 */
trait ValueAttribute
{
    use AbstractTag;

    /**
     * @param string $value
     *
     * @return static
     */
    public function setValue(string $value)
    {
        $this->getTag()->setAttribute('value', $value);

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
     * @todo return type conflicts with Component::getValue()
     *
     * Returns the value of the input.
     *
     * @return string
     */
    public function getValue()
    {
        $value = $this->getTag()->getAttribute('value');

        return $value === null ? '' : $value;
    }

    /**
     * Returns the value of the input, or null if empty.
     *
     * @return string|null
     */
    public function getValueOrNull() : ?string
    {
        $value = $this->getTag()->getAttribute('value');

        return $value === '' ? null : $value;
    }
}
