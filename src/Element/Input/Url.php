<?php

declare(strict_types=1);

namespace Brick\Form\Element\Input;

use Brick\Form\Element\Input;
use Brick\Form\Attribute\AutocompleteAttribute;
use Brick\Form\Attribute\ListAttribute;
use Brick\Form\Attribute\MaxLengthAttribute;
use Brick\Form\Attribute\PatternAttribute;
use Brick\Form\Attribute\PlaceholderAttribute;
use Brick\Form\Attribute\ReadOnlyAttribute;
use Brick\Form\Attribute\RequiredAttribute;
use Brick\Form\Attribute\SizeAttribute;
use Brick\Form\Attribute\ValueAttribute;
use Brick\Validation\Validator\UrlValidator;

/**
 * Represents a url input element.
 */
class Url extends Input
{
    use AutocompleteAttribute;
    use ListAttribute;
    use MaxLengthAttribute;
    use PatternAttribute;
    use PlaceholderAttribute;
    use ReadOnlyAttribute;
    use RequiredAttribute;
    use SizeAttribute;
    use ValueAttribute;

    /**
     * {@inheritdoc}
     */
    protected function init() : void
    {
        $this->addValidator(new UrlValidator());
    }

    /**
     * {@inheritdoc}
     */
    protected function getType() : string
    {
        return 'url';
    }

    /**
     * {@inheritdoc}
     */
    protected function doPopulate($value) : void
    {
        $this->setValue($value);
    }
}
