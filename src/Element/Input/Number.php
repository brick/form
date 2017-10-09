<?php

declare(strict_types=1);

namespace Brick\Form\Element\Input;

use Brick\Form\Element\Input;
use Brick\Form\Attribute\AutocompleteAttribute;
use Brick\Form\Attribute\ListAttribute;
use Brick\Form\Attribute\MinMaxStepAttributes;
use Brick\Form\Attribute\PlaceholderAttribute;
use Brick\Form\Attribute\ReadOnlyAttribute;
use Brick\Form\Attribute\RequiredAttribute;
use Brick\Form\Attribute\ValueAttribute;
use Brick\Validation\Validator\NumberValidator;

/**
 * Represents a number input element.
 */
class Number extends Input
{
    use AutocompleteAttribute;
    use ListAttribute;
    use MinMaxStepAttributes;
    use PlaceholderAttribute;
    use ReadOnlyAttribute;
    use RequiredAttribute;
    use ValueAttribute;

    /**
     * @var NumberValidator
     */
    private $validator;

    /**
     * {@inheritdoc}
     */
    protected function init() : void
    {
        $this->validator = new NumberValidator();
        $this->validator->setStep('1');

        $this->addValidator($this->validator);
    }

    /**
     * {@inheritdoc}
     */
    protected function getType() : string
    {
        return 'number';
    }

    /**
     * {@inheritdoc}
     */
    protected function doSetMin(string $min) : void
    {
        $this->validator->setMin($min);
    }

    /**
     * {@inheritdoc}
     */
    protected function doSetMax(string $max) : void
    {
        $this->validator->setMax($max);
    }

    /**
     * {@inheritdoc}
     */
    protected function doSetStep(string $step) : void
    {
        $this->validator->setStep($step === 'any' ? null : $step);
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $this->setValue($value);
    }
}
