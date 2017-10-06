<?php

declare(strict_types=1);

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
     * @return void
     */
    public function addError(string $errorMessage) : void
    {
        $this->errors[] = $errorMessage;
    }

    /**
     * @return void
     */
    public function resetErrors() : void
    {
        $this->errors = [];
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
