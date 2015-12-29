<?php

namespace Brick\Form\Attribute;

use Brick\Validation\Validator\StringValidator;

/**
 * Provides the maxlength attribute to inputs.
 */
trait MaxLengthAttribute
{
    use AbstractTag;

    /**
     * @param string $maxLength
     *
     * @return static
     */
    public function setMaxLength($maxLength)
    {
        $this->getTag()->setAttribute('maxlength', $maxLength);
        $this->removeValidators(StringValidator::class);

        if ($maxLength !== '') {
            $validator = new StringValidator(0, $maxLength);
            $this->addValidator($validator);
        }

        return $this;
    }
}
