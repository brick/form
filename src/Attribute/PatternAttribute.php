<?php

declare(strict_types=1);

namespace Brick\Form\Attribute;

use Brick\Validation\Validator\PatternValidator;

/**
 * Provides the pattern attribute to inputs.
 */
trait PatternAttribute
{
    use IsElement;

    /**
     * @param string $pattern
     *
     * @return static
     */
    public function setPattern(string $pattern)
    {
        $this->getTag()->setAttribute('pattern', $pattern);
        $this->removeValidators(PatternValidator::class);

        if ($pattern !== '') {
            $this->addValidator(new PatternValidator($pattern));
        }

        return $this;
    }

    /**
     * @return static
     */
    public function removePattern()
    {
        $this->getTag()->removeAttribute('pattern');
        $this->removeValidators(PatternValidator::class);

        return $this;
    }
}
