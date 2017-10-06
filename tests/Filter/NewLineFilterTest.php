<?php

namespace Brick\Form\Tests\Filter;

use Brick\Form\Filter\NewLineFilter;

use PHPUnit\Framework\TestCase;

/**
 * Tests for class NewLineFilter.
 */
class NewLineFilterTest extends TestCase
{
    /**
     * @dataProvider providerFilter
     *
     * @param string $value       The value to filter.
     * @param string $replaceWith The string to replace new lines with.
     * @param string $expected    The expected filtered value.
     */
    public function testFilter($value, $replaceWith, $expected)
    {
        $filter = new NewLineFilter($replaceWith);
        $this->assertSame($expected, $filter($value));
    }

    /**
     * @return array
     */
    public function providerFilter()
    {
        return [
            ['', '', ''],
            ["a\r\nb\rc\nd", '', 'abcd'],
            ["a\r\nb\rc\nd", ' ', 'a b c d'],
            ["a\n\r\r\n\n\r\nb", '-', 'a-----b'],
        ];
    }
}
