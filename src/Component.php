<?php

declare(strict_types=1);

namespace Brick\Form;

use Brick\Validation\Validator;

/**
 * Base class for Element and Group. Aggregated by Form.
 */
abstract class Component extends Base
{
    /**
     * The owning form.
     *
     * @var Form
     */
    protected $form;

    /**
     * @var bool
     */
    protected $required = false;

    /**
     * @var callable[]
     */
    private $filters = [];

    /**
     * @var Validator[]
     */
    private $validators = [];

    /**
     * Class constructor.
     *
     * @param Form   $form
     * @param string $name
     */
    public function __construct(Form $form, string $name)
    {
        $this->form = $form;

        $this->setName($name);
        $this->init();
    }

    /**
     * Populates the component with the given value.
     *
     * The value will be filtered and validated.
     * Validation errors will be accessible via hasErrors() and getErrors().
     *
     * @param string|array|null $value
     *
     * @return void
     *
     * @throws \InvalidArgumentException If the given value is not of a correct type for this component.
     */
    public function populate($value) : void
    {
        $isArray = $this->isArray();

        if ($value === null) {
            $value = $isArray ? [] : '';
        } else {
            $isCorrectType = $isArray ? is_array($value) : is_string($value);

            if (! $isCorrectType) {
                throw new \InvalidArgumentException(sprintf(
                    'Invalid value received for "%s": expected %s, got %s',
                    $this->getName(),
                    $isArray ? 'array' : 'string',
                    gettype($value)
                ));
            }
        }

        $this->resetErrors();

        $empty = ($value === '' || $value === []);

        if ($empty && $this->required) {
            $this->addTranslatableError('form.required', 'This field is required.');
        }

        if (! $empty && ! $isArray) {
            $value = $this->filter($value);
            $this->validate($value);
        }

        $this->doPopulate($value);
    }

    /**
     * @param bool $required
     *
     * @return static
     */
    public function setRequired(bool $required) : Component
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired() : bool
    {
        return $this->required;
    }

    /**
     * @param string $messageKey     The unique message key for the translation system.
     * @param string $defaultMessage The default message in English, if no translator is available.
     *
     * @return void
     */
    private function addTranslatableError(string $messageKey, string $defaultMessage) : void
    {
        $message = $defaultMessage;

        if (null !== $translator = $this->form->getTranslator()) {
            $translatedMessage = $translator($messageKey);
            if ($translatedMessage !== null) {
                $message = $translatedMessage;
            }
        }

        $this->addError($message);
    }

    /**
     * @param string $value
     *
     * @return string
     */
    private function filter(string $value) : string
    {
        foreach ($this->filters as $filter) {
            $value = $filter($value);
        }

        return $value;
    }

    /**
     * @param string $value
     *
     * @return void
     */
    private function validate(string $value) : void
    {
        foreach ($this->validators as $validator) {
            if (! $validator->isValid($value)) {
                foreach ($validator->getFailureMessages() as $messageKey => $message) {
                    $this->addTranslatableError($messageKey, $message);
                }
            }
        }
    }

    /**
     * Adds a filter.
     *
     * A filter can be any function or closure that accepts a string and returns a string.
     *
     * @param callable $filter The filter function.
     *
     * @return static
     */
    public function addFilter(callable $filter) : Component
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * Adds a validator.
     *
     * Adding twice the same instance of a validator has no effect.
     *
     * @param Validator $validator
     *
     * @return static
     */
    public function addValidator(Validator $validator) : Component
    {
        $hash = spl_object_hash($validator);
        $this->validators[$hash] = $validator;

        return $this;
    }

    /**
     * Checks whether a validator is present.
     *
     * @param Validator $validator
     *
     * @return bool
     */
    protected function hasValidator(Validator $validator) : bool
    {
        $hash = spl_object_hash($validator);

        return isset($this->validators[$hash]);
    }

    /**
     * Removes a validator.
     *
     * Removing a non-existent validator has no effect.
     *
     * @param Validator $validator
     *
     * @return static
     */
    protected function removeValidator(Validator $validator) : Component
    {
        $hash = spl_object_hash($validator);
        unset($this->validators[$hash]);

        return $this;
    }

    /**
     * Removes all validators of the given class name.
     *
     * @param string $className
     *
     * @return static
     */
    protected function removeValidators(string $className) : Component
    {
        foreach ($this->validators as $key => $validator) {
            if ($validator instanceof $className) {
                unset($this->validators[$key]);
            }
        }

        return $this;
    }

    /**
     * Initializes the component.
     *
     * This method is called at the end of the constructor.
     *
     * @return void
     */
    protected function init() : void
    {
    }

    /**
     * Populates the component with the value(s) received from the form submission.
     *
     * Not all components care with a value, reset buttons for example will not implement this method.
     *
     * @param string|array $value
     *
     * @return void
     */
    protected function doPopulate($value) : void
    {
    }

    /**
     * Returns whether the Component expects an array as input data.
     *
     * This method is to be overridden only by components which can return an array.
     *
     * @return bool True if the component expects an array, false if it expects a string.
     */
    protected function isArray() : bool
    {
        return false;
    }

    /**
     * Sets the name of the component, that will be posted in the form data.
     *
     * @param string $name
     *
     * @return void
     */
    abstract protected function setName(string $name) : void;

    /**
     * Returns the name of the component, that will be posted in the form data.
     *
     * @return string
     */
    abstract public function getName() : string;

    /**
     * @return string|array|null
     */
    abstract public function getValue();

    /**
     * @return string
     */
    abstract public function __toString() : string;
}
