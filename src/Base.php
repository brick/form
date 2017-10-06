<?php

namespace Brick\Form;

/**
 * Base class for Form & Component.
 */
abstract class Base
{
    /**
     * @var string[]
     */
    private $errors = [];

    /**
     * @param string $errorMessage
     *
     * @return static
     */
    public function addError(string $errorMessage) : Base
    {
        $this->errors[] = $errorMessage;

        return $this;
    }

    /**
     * @return static
     */
    public function resetErrors() : Base
    {
        $this->errors = [];

        return $this;
    }

    /**
     * @return bool
     */
    public function hasErrors() : bool
    {
        return count($this->errors) !== 0;
    }

    /**
     * @return string[]
     */
    public function getErrors() : array
    {
        return $this->errors;
    }
}
