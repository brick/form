<?php

declare(strict_types=1);

namespace Brick\Form\Element\Input;

use Brick\Form\Attribute\FormAttributes;
use Brick\Form\Element\Input;

/**
 * Represents an image input element.
 */
class Image extends Input
{
    // @todo alt, height, src, width attributes
    use FormAttributes;

    /**
     * {@inheritdoc}
     */
    protected function getType() : string
    {
        return 'image';
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return null;
    }
}
