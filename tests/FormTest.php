<?php

namespace Brick\Form\Tests;

use Brick\Form\Form;
use Brick\Form\Element\Input\{
    Input,
    Button as InputButton,
    Checkbox,
    Color,
    Date,
    DateTime,
    DateTimeLocal,
    Email,
    File,
    Hidden,
    Image,
    Month,
    Number,
    Password,
    Radio,
    Range,
    Reset as InputReset,
    Search,
    Submit as InputSubmit,
    Tel,
    Time,
    Url,
    Week
};
use Brick\Form\Element\TextArea;
use Brick\Form\Group\InputGroup;
use Brick\Form\Element\Button\{Button, Reset, Submit};

use PHPUnit\Framework\TestCase;

/**
 * Unit tests for Brick\Form.
 */
class FormTest extends TestCase
{
    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage Duplicate component name 
     */
    public function testAddComponentShouldThrowRuntimeException()
    {
        $form = new Form();
        $form->addButtonButton('submit');
        $form->addButtonButton('submit');
    }

    public function testAddButtonButton()
    {
        $form = new Form();
        $button = $form->addButtonButton('submit_button');

        $this->assertInstanceOf(Button::class, $button);
        $this->assertSame(['submit_button' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><button type="button" name="submit_button" id="%s"></button></form>', (string) $form);
    }

    public function testGetComponent()
    {
        $form = new Form();
        $form->addButtonButton('submit');

        $this->assertInstanceOf(Button::class, $form->getComponent('submit'));
    }

    /**
     * @expectedException        \RuntimeException
     * @expectedExceptionMessage No component named "invalid_name"
     */
    public function testGetComponentShouldThrowRuntimeException()
    {
        $form = new Form();
        $form->getComponent('invalid_name');
    }

    public function testGetComponents()
    {
        $form = new Form();
        $form->addButtonButton('submit');

        $this->assertArrayHasKey('submit', $form->getComponents());
    }

    public function testAddButtonReset()
    {
        $form = new Form();

        $this->assertInstanceOf(Reset::class, $form->addButtonReset('reset_button'));
        $this->assertSame(['reset_button' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><button type="reset" name="reset_button" id="%s"></button></form>', (string) $form);
    }

    public function testAddButtonSubmit()
    {
        $form = new Form();

        $this->assertInstanceOf(Submit::class, $form->addButtonSubmit('submit_button'));
        $this->assertSame(['submit_button' => ''], $form->getValues());
            $this->assertStringMatchesFormat('<form><button type="submit" name="submit_button" id="%s"></button></form>', (string) $form);
    }

    public function testAddInputButton()
    {
        $form = new Form();

        $this->assertInstanceOf(InputButton::class, $form->addInputButton('input_button'));
        $this->assertSame(['input_button' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="button" name="input_button" id="%s"></form>', (string) $form);
    }

    public function testAddInputCheckbox()
    {
        $form = new Form();

        $this->assertInstanceOf(Checkbox::class, $form->addInputCheckbox('input_checkbox'));
        $this->assertSame(['input_checkbox' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="checkbox" name="input_checkbox" id="%s"></form>', (string) $form);
    }

    public function testAddInputColor()
    {
        $form = new Form();

        $this->assertInstanceOf(Color::class, $form->addInputColor('input_color'));
        $this->assertSame(['input_color' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="color" name="input_color" id="%s"></form>', (string) $form);
    }

    public function testAddInputDate()
    {
        $form = new Form();

        $this->assertInstanceOf(Date::class, $form->addInputDate('input_date'));
        $this->assertSame(['input_date' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="date" name="input_date" id="%s"></form>', (string) $form);
    }

    public function testAddInputDateTime()
    {
        $form = new Form();

        $this->assertInstanceOf(DateTime::class, $form->addInputDateTime('input_datetime'));
        $this->assertSame(['input_datetime' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="datetime" name="input_datetime" id="%s"></form>', (string) $form);
    }

    public function testAddInputDateTimeLocal()
    {
        $form = new Form();

        $this->assertInstanceOf(DateTimeLocal::class, $form->addInputDateTimeLocal('input_datetimelocal'));
        $this->assertSame(['input_datetimelocal' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="datetime-local" name="input_datetimelocal" id="%s"></form>', (string) $form);
    }

    public function testAddInputEmail()
    {
        $form = new Form();

        $this->assertInstanceOf(Email::class, $form->addInputEmail('input_email'));
        $this->assertSame(['input_email' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="email" name="input_email" id="%s"></form>', (string) $form);
    }

    public function testAddInputFile()
    {
        $form = new Form();

        $this->assertInstanceOf(File::class, $form->addInputFile('input_file'));
        $this->assertSame(['input_file' => null], $form->getValues());
        $this->assertStringMatchesFormat('<form enctype="multipart/form-data"><input type="file" name="input_file" id="%s"></form>', (string) $form);
    }

    public function testAddInputHidden()
    {
        $form = new Form();

        $this->assertInstanceOf(Hidden::class, $form->addInputHidden('input_hidden'));
        $this->assertSame(['input_hidden' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="hidden" name="input_hidden" id="%s"></form>', (string) $form);
    }

    public function testAddInputImage()
    {
        $form = new Form();

        $this->assertInstanceOf(Image::class, $form->addInputImage('input_image'));
        $this->assertSame(['input_image' => null], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="image" name="input_image" id="%s"></form>', (string) $form);
    }

    public function testAddInputMonth()
    {
        $form = new Form();

        $this->assertInstanceOf(Month::class, $form->addInputMonth('input_month'));
        $this->assertSame(['input_month' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="month" name="input_month" id="%s"></form>', (string) $form);
    }

    public function testAddInputNumber()
    {
        $form = new Form();

        $this->assertInstanceOf(Number::class, $form->addInputNumber('input_number'));
        $this->assertSame(['input_number' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="number" name="input_number" id="%s"></form>', (string) $form);
    }

    public function testAddInputPassword()
    {
        $form = new Form();

        $this->assertInstanceOf(Password::class, $form->addInputPassword('input_password'));
        $this->assertSame(['input_password' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="password" name="input_password" id="%s"></form>', (string) $form);
    }

    public function testAddInputRadio()
    {
        $form = new Form();

        $this->assertInstanceOf(Radio::class, $form->addInputRadio('input_radio'));
        $this->assertSame(['input_radio' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="radio" name="input_radio" id="%s"></form>', (string) $form);
    }

    public function testAddInputRange()
    {
        $form = new Form();

        $this->assertInstanceOf(Range::class, $form->addInputRange('input_range'));
        $this->assertSame(['input_range' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="range" name="input_range" id="%s"></form>', (string) $form);
    }

    public function testAddInputReset()
    {
        $form = new Form();

        $this->assertInstanceOf(InputReset::class, $form->addInputReset('input_reset'));
        $this->assertSame(['input_reset' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="reset" name="input_reset" id="%s"></form>', (string) $form);
    }
 
    public function testAddInputSearch()
    {
        $form = new Form();

        $this->assertInstanceOf(Search::class, $form->addInputSearch('input_search'));
        $this->assertSame(['input_search' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="search" name="input_search" id="%s"></form>', (string) $form);
    }

    public function testAddInputSubmit()
    {
        $form = new Form();

        $this->assertInstanceOf(InputSubmit::class, $form->addInputSubmit('input_submit'));
        $this->assertSame(['input_submit' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="submit" name="input_submit" id="%s"></form>', (string) $form);
    }

    public function testAddInputTel()
    {
        $form = new Form();

        $this->assertInstanceOf(Tel::class, $form->addInputTel('input_tel'));
        $this->assertSame(['input_tel' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="tel" name="input_tel" id="%s"></form>', (string) $form);
    }

    public function testAddInputTime()
    {
        $form = new Form();

        $this->assertInstanceOf(Time::class, $form->addInputTime('input_time'));
        $this->assertSame(['input_time' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="time" name="input_time" id="%s"></form>', (string) $form);
    }

    public function testAddInputUrl()
    {
        $form = new Form();

        $this->assertInstanceOf(Url::class, $form->addInputUrl('input_url'));
        $this->assertSame(['input_url' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="url" name="input_url" id="%s"></form>', (string) $form);
    }

    public function testAddInputWeek()
    {
        $form = new Form();

        $this->assertInstanceOf(Week::class, $form->addInputWeek('input_week'));
        $this->assertSame(['input_week' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><input type="week" name="input_week" id="%s"></form>', (string) $form);
    }

    public function testAddTextarea()
    {
        $form = new Form();

        $this->assertInstanceOf(Textarea::class, $form->addTextarea('the_textarea'));
        $this->assertSame(['the_textarea' => ''], $form->getValues());
        $this->assertStringMatchesFormat('<form><textarea name="the_textarea" id="%s"></textarea></form>', (string) $form);
    }

    public function testAddInputGroup()
    {
        $form = new Form();

        $this->assertInstanceOf(InputGroup::class, $form->addInputGroup('input_group'));
        $this->assertSame(['input_group' => []], $form->getValues());
        $this->assertSame('<form></form>', (string) $form);
    }

    public function testSetAction()
    {
        $form = new Form();
        $form->setAction('action_target');

        $this->assertSame('<form action="action_target"></form>', (string) $form);
    }
 
    public function testGetAction()
    {
        $form = new Form();
        $form->setAction('action_target');

        $this->assertSame('action_target', $form->getAction());
    }

    public function testSetMethodGet()
    {
        $form = new Form();
        $form->setMethodGet();

        $this->assertSame('<form method="get"></form>', (string) $form);
    }

    public function testSetMethodPost()
    {
        $form = new Form();
        $form->setMethodPost();

        $this->assertSame('<form method="post"></form>', (string) $form);
    }

    public function testGetMethod()
    {
        $form = new Form();

        $this->assertNull($form->getMethod());

        $form->setMethodGet();

        $this->assertSame('get', $form->getMethod());
    }

    public function testIsMethodGet()
    {
        $form = new Form();

        $this->assertTrue($form->isMethodGet());

        $form->setMethodGet();

        $this->assertTrue($form->isMethodGet());

        $form->setMethodPost();

        $this->assertFalse($form->isMethodGet());
    }

    public function testIsMethodPost()
    {
        $form = new Form();

        $this->assertFalse($form->isMethodPost());

        $form->setMethodPost();

        $this->assertTrue($form->isMethodPost());
    }

    public function testSetEnctypeUrlencoded()
    {
        $form = new Form();
        $form->setEnctypeUrlencoded();

        $this->assertSame('<form enctype="application/x-www-form-urlencoded"></form>', (string) $form);
    }

    public function testSetEnctypeTextPlain()
    {
        $form = new Form();
        $form->setEnctypeTextPlain();

        $this->assertSame('<form enctype="text/plain"></form>', (string) $form);
    }

    public function testGetEnctype()
    {
        $form = new Form();
        $form->setEnctypeTextPlain();

        $this->assertSame('text/plain', $form->getEnctype());
    }

    public function testSetAttribute()
    {
        $form = new Form();
        $form->setAttribute('name', 'my_form');

        $this->assertSame('<form name="my_form"></form>', (string) $form);
    }

    public function testSetAttributes()
    {
        $form = new Form();
        $form->setAttributes(['name' => 'my_form', 'style' => 'color: red;']);

        $this->assertSame('<form name="my_form" style="color: red;"></form>', (string) $form);
    }

    public function testGetAllErrorsShouldReturnEmptyArray()
    {
        $form = new Form();

        $this->assertSame([], $form->getAllErrors());
    }

    public function testSingleSelect()
    {
        // Setup some drinks, and which one should be checked.
        $drinks = ['water', 'beer', 'wine'];
        $selectedDrink = 'beer';

        $form = new Form();
        $select = $form->addSingleSelect('drink');

        foreach ($drinks as $drink) {
            $select->addOption($drink, $drink);
        }

        try {
            $form->populate([
                'drink' => []
            ]);

            $this->fail('Should complain that SingleSelect does not accept an array');
        } catch (\InvalidArgumentException $e) {
            // Works as expected!
        }

        $this->assertTrue($form->populate([
            'drink' => $selectedDrink
        ])->isValid());

        $this->assertEquals($selectedDrink, $select->getValue());
    }

    public function testMultipleSelect()
    {
        // Setup some country codes, and whether they should be checked.
        $countries = [
            'US' => false,
            'GB' => true,
            'FR' => true
        ];

        $form = new Form();
        $select = $form->addMultipleSelect('countries');

        foreach ($countries as $code => $checked) {
            $select->addOption($code, $code);
        }

        try {
            $form->populate([
                'countries' => 'US'
            ]);

            $this->fail('Should complain that MultipleSelect does not accept a string');
        } catch (\InvalidArgumentException $e) {
            // Works as expected!
        }

        $expected = array_keys($countries, true);
        sort($expected);

        $this->assertTrue($form->populate([
            'countries' => $expected
        ])->isValid());

        $actual = $select->getValues();
        sort($actual);

        $this->assertEquals($expected, $actual);
    }

    public function testSelectOptionGroups()
    {
        $form = new Form();
        $country = $form->addSingleSelect('country');

        $country->addOptionGroup('Europe')->addOptions([
            'GB' => 'United Kingdom',
            'IE' => 'Ireland',
            'FR' => 'France'
        ]);

        $country->addOptionGroup('America')->addOptions([
            'US' => 'United States',
            'CA' => 'Canada'
        ]);

        $country->addOption('Antarctica', 'AQ');

        $country->setValue('US');

        $this->assertEquals('US', $country->getValue());

        $id = $country->getId();

        $html =
            '<select name="country" id="' . $id . '">' .
            '<optgroup label="Europe">' .
            '<option value="GB">United Kingdom</option>' .
            '<option value="IE">Ireland</option>' .
            '<option value="FR">France</option>' .
            '</optgroup>' .
            '<optgroup label="America">' .
            '<option value="US" selected="selected">United States</option>' .
            '<option value="CA">Canada</option>' .
            '</optgroup>' .
            '<option value="AQ">Antarctica</option>' .
            '</select>';

        $this->assertEquals($html, $country->render());
    }

    public function testRadioGroup()
    {
        // Setup some drinks, and which one should be checked.
        $drinks = ['water', 'beer', 'wine'];
        $selectedDrink = 'beer';

        $form = new Form();
        $radioButtons = $form->addRadioGroup('drink');

        foreach ($drinks as $drink) {
            $radioButtons->addRadio()->setValue($drink);
        }

        try {
            $form->populate([
                'drink' => []
            ]);

            $this->fail('Should complain that RadioGroup does not accept an array');
        } catch (\InvalidArgumentException $e) {
            // Works as expected!
        }

        $this->assertTrue($form->populate([
            'drink' => $selectedDrink
        ])->isValid());

        foreach ($radioButtons->getElements() as $radioButton) {
            $shouldBeChecked = ($radioButton->getValue() == $selectedDrink);
            $this->assertEquals($radioButton->isChecked(), $shouldBeChecked);
        }
    }

    public function testRequiredInput()
    {
        $form = new Form();
        $form->addInputText('city')->setRequired(true);

        $this->assertFalse($form->populate([])->isValid());
        $this->assertFalse($form->populate(['city' => ''])->isValid());
        $this->assertTrue($form->populate(['city' => 'London'])->isValid());
    }

    public function testCheckboxGroup()
    {
        // Setup some country codes, and whether they should be checked.
        $countries = [
            'US' => false,
            'GB' => true,
            'FR' => true
        ];

        $form = new Form();
        $countryCheckboxes = $form->addCheckboxGroup('countries');

        foreach ($countries as $code => $checked) {
            $countryCheckboxes->addCheckbox()->setValue($code);
        }

        try {
            $form->populate([
                'countries' => 'US'
            ]);

            $this->fail('Should complain that CheckboxGroup does not accept a string');
        } catch (\InvalidArgumentException $e) {
            // Works as expected!
        }

        $this->assertTrue($form->populate([
            'countries' => array_keys($countries, true)
        ])->isValid());

        foreach ($countryCheckboxes->getElements() as $checkbox) {
            $shouldBeChecked = $countries[$checkbox->getValue()];
            $this->assertEquals($checkbox->isChecked(), $shouldBeChecked);
        }
    }
}
