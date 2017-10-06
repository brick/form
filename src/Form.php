<?php

namespace Brick\Form;

use Brick\Html\Tag;
use Brick\Http\Request;
use Brick\Translation\Translator;

/**
 * Represents an HTML form.
 */
class Form extends Base
{
    /**
     * @var Tag|null
     */
    private $tag;

    /**
     * @var Component[]
     */
    private $components = [];

    /**
     * @var array
     */
    private $ids = [];

    /**
     * @var Translator|null
     */
    private $translator;

    /**
     * @param Element $element
     *
     * @return string
     */
    public function generateElementId(Element $element) : string
    {
        preg_match('/^([a-zA-Z0-9]*)/', $element->getName(), $matches);
        $name = $matches[0];

        if (! isset($this->ids[$name])) {
            $this->ids[$name] = 0;
        }

        return $this->getId() . '-' . $name . '-' . $this->ids[$name]++;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        $tag = $this->getTag();

        if (! $tag->hasAttribute('id')) {
            $tag->setAttribute('id', $this->generateUid());
        }

        return $tag->getAttribute('id');
    }

    /**
     * @return string
     */
    private function generateUid() : string
    {
        preg_match('/^0\.([0-9]+) ([0-9]+)$/', microtime(), $matches);

        return 'form-' . $matches[2] . '-' . $matches[1];
    }

    /**
     * @return Tag
     */
    private function getTag() : Tag
    {
        if ($this->tag === null) {
            $this->tag = new Tag('form');
        }

        return $this->tag;
    }

    /**
     * @param string    $name
     * @param Component $component
     *
     * @return Component
     *
     * @throws \RuntimeException
     */
    private function addComponent(string $name, Component $component) : Component
    {
        if (isset($this->components[$name])) {
            throw new \RuntimeException(sprintf('Duplicate component name "%s"', $name));
        }

        $this->components[$name] = $component;

        return $component;
    }

    /**
     * @return \Brick\Form\Component[]
     */
    public function getComponents() : array
    {
        return $this->components;
    }

    /**
     * @param string $name
     *
     * @return Component
     *
     * @throws \RuntimeException
     */
    public function getComponent(string $name) : Component
    {
        if (isset($this->components[$name])) {
            return $this->components[$name];
        }

        throw new \RuntimeException(sprintf('No component named "%s"', $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Button\Button
     */
    public function addButtonButton(string $name) : Element\Button\Button
    {
        return $this->addComponent($name, new Element\Button\Button($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Button\Reset
     */
    public function addButtonReset(string $name) : Element\Button\Reset
    {
        return $this->addComponent($name, new Element\Button\Reset($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Button\Submit
     */
    public function addButtonSubmit(string $name) : Element\Button\Submit
    {
        return $this->addComponent($name, new Element\Button\Submit($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Button
     */
    public function addInputButton(string $name) : Element\Input\Button
    {
        return $this->addComponent($name, new Element\Input\Button($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Checkbox
     */
    public function addInputCheckbox(string $name) : Element\Input\Checkbox
    {
        return $this->addComponent($name, new Element\Input\Checkbox($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Color
     */
    public function addInputColor(string $name) : Element\Input\Color
    {
        return $this->addComponent($name, new Element\Input\Color($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Date
     */
    public function addInputDate(string $name) : Element\Input\Date
    {
        return $this->addComponent($name, new Element\Input\Date($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\DateTime
     */
    public function addInputDateTime(string $name) : Element\Input\DateTime
    {
        return $this->addComponent($name, new Element\Input\DateTime($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\DateTimeLocal
     */
    public function addInputDateTimeLocal(string $name) : Element\Input\DateTimeLocal
    {
        return $this->addComponent($name, new Element\Input\DateTimeLocal($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Email
     */
    public function addInputEmail(string $name) : Element\Input\Email
    {
        return $this->addComponent($name, new Element\Input\Email($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\File
     */
    public function addInputFile(string $name) : Element\Input\File
    {
        $this->setEnctypeMultipart();

        return $this->addComponent($name, new Element\Input\File($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Hidden
     */
    public function addInputHidden(string $name) : Element\Input\Hidden
    {
        return $this->addComponent($name, new Element\Input\Hidden($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Image
     */
    public function addInputImage(string $name) : Element\Input\Image
    {
        return $this->addComponent($name, new Element\Input\Image($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Month
     */
    public function addInputMonth(string $name) : Element\Input\Month
    {
        return $this->addComponent($name, new Element\Input\Month($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Number
     */
    public function addInputNumber(string $name) : Element\Input\Number
    {
        return $this->addComponent($name, new Element\Input\Number($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Password
     */
    public function addInputPassword(string $name) : Element\Input\Password
    {
        return $this->addComponent($name, new Element\Input\Password($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Radio
     */
    public function addInputRadio(string $name) : Element\Input\Radio
    {
        return $this->addComponent($name, new Element\Input\Radio($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Range
     */
    public function addInputRange(string $name) : Element\Input\Range
    {
        return $this->addComponent($name, new Element\Input\Range($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Reset
     */
    public function addInputReset(string $name) : Element\Input\Reset
    {
        return $this->addComponent($name, new Element\Input\Reset($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Search
     */
    public function addInputSearch(string $name) : Element\Input\Search
    {
        return $this->addComponent($name, new Element\Input\Search($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Submit
     */
    public function addInputSubmit(string $name) : Element\Input\Submit
    {
        return $this->addComponent($name, new Element\Input\Submit($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Tel
     */
    public function addInputTel(string $name) : Element\Input\Tel
    {
        return $this->addComponent($name, new Element\Input\Tel($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Text
     */
    public function addInputText(string $name) : Element\Input\Text
    {
        return $this->addComponent($name, new Element\Input\Text($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Time
     */
    public function addInputTime(string $name) : Element\Input\Time
    {
        return $this->addComponent($name, new Element\Input\Time($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Url
     */
    public function addInputUrl(string $name) : Element\Input\Url
    {
        return $this->addComponent($name, new Element\Input\Url($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Input\Week
     */
    public function addInputWeek(string $name) : Element\Input\Week
    {
        return $this->addComponent($name, new Element\Input\Week($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Select\SingleSelect
     */
    public function addSingleSelect(string $name) : Element\Select\SingleSelect
    {
        return $this->addComponent($name, new Element\Select\SingleSelect($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Element\Select\MultipleSelect
     */
    public function addMultipleSelect(string $name) : Element\Select\MultipleSelect
    {
        return $this->addComponent($name, new Element\Select\MultipleSelect($this, $name . '[]'));
    }

    /**
     * @param string $name
     *
     * @return Element\Textarea
     */
    public function addTextarea(string $name) : Element\Textarea
    {
        return $this->addComponent($name, new Element\Textarea($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Group\CheckboxGroup
     */
    public function addCheckboxGroup(string $name) : Group\CheckboxGroup
    {
        return $this->addComponent($name, new Group\CheckboxGroup($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Group\RadioGroup
     */
    public function addRadioGroup(string $name) : Group\RadioGroup
    {
        return $this->addComponent($name, new Group\RadioGroup($this, $name));
    }

    /**
     * @param string $name
     *
     * @return Group\InputGroup
     */
    public function addInputGroup(string $name) : Group\InputGroup
    {
        return $this->addComponent($name, new Group\InputGroup($this, $name));
    }

    /**
     * @param string $action
     *
     * @return Form
     */
    public function setAction(string $action) : Form
    {
        $this->getTag()->setAttribute('action', $action);

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAction() : ?string
    {
        return $this->getTag()->getAttribute('action');
    }

    /**
     * @return Form
     */
    public function setMethodGet() : Form
    {
        $this->getTag()->setAttribute('method', 'get');

        return $this;
    }

    /**
     * @return Form
     */
    public function setMethodPost() : Form
    {
        $this->getTag()->setAttribute('method', 'post');

        return $this;
    }

    /**
     * @return string|null
     */
    public function getMethod() : ?string
    {
        return $this->getTag()->getAttribute('method');
    }

    /**
     * Returns whether the form method is get. This is the default if no method is set.
     *
     * @return bool
     */
    public function isMethodGet() : bool
    {
        return ! $this->isMethodPost();
    }

    /**
     * Returns whether the form method is post.
     *
     * @return bool
     */
    public function isMethodPost() : bool
    {
        return $this->getMethod() === 'post';
    }

    /**
     * @return Form
     */
    public function setEnctypeUrlencoded() : Form
    {
        $this->getTag()->setAttribute('enctype', 'application/x-www-form-urlencoded');

        return $this;
    }

    /**
     * @return Form
     */
    public function setEnctypeMultipart() : Form
    {
        $this->getTag()->setAttribute('enctype', 'multipart/form-data');

        return $this;
    }

    /**
     * @return Form
     */
    public function setEnctypeTextPlain() : Form
    {
        $this->getTag()->setAttribute('enctype', 'text/plain');

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEnctype() : ?string
    {
        return $this->getTag()->getAttribute('enctype');
    }

    /**
     * @todo sanity check: should not be used for 'method', 'enctype', etc.?
     *
     * @param string $name
     * @param string $value
     *
     * @return Form
     */
    public function setAttribute(string $name, string $value) : Form
    {
        $this->getTag()->setAttribute($name, $value);

        return $this;
    }

    /**
     * @param array $attributes
     *
     * @return Form
     */
    public function setAttributes(array $attributes) : Form
    {
        $this->getTag()->setAttributes($attributes);

        return $this;
    }

    /**
     * Renders the opening tag.
     *
     * @return string
     */
    public function open() : string
    {
        return $this->getTag()->renderOpeningTag();
    }

    /**
     * Renders the closing tag.
     *
     * @return string
     */
    public function close() : string
    {
        return $this->getTag()->renderClosingTag();
    }

    /**
     * Populates the form with an associative array of data.
     *
     * @param array $data
     *
     * @return Form
     */
    public function populate(array $data) : Form
    {
        $this->resetErrors();

        foreach ($this->components as $name => $component) {
            $value = isset($data[$name]) ? $data[$name] : null;
            $component->populate($value);
        }

        return $this;
    }

    /**
     * Populates the form with the request data.
     *
     * @param Request $request
     *
     * @return Form
     */
    public function populateFromRequest(Request $request) : Form
    {
        return $this->populate(
            $this->isMethodPost()
                ? $request->getPost()
                : $request->getQuery()
        );
    }

    /**
     * Validates the form, and adds errors when required.
     *
     * This method is only meant to be implemented by subclasses, to call `addError()` on the form itself,
     * and/or on its components. This allows forms to perform custom validation on top of component validators.
     *
     * @return void
     */
    protected function validate() : void
    {
    }

    /**
     * Returns whether the form is valid.
     *
     * @return bool
     */
    public function isValid() : bool
    {
        $this->validate();

        if ($this->hasErrors()) {
            return false;
        }

        foreach ($this->components as $component) {
            if ($component->hasErrors()) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return array
     */
    public function getValues() : array
    {
        $values = [];

        foreach ($this->components as $name => $component) {
            $values[$name] = $component->getValue();
        }

        return $values;
    }

    /**
     * Returns all form-level errors and component-level errors.
     *
     * @return string[]
     */
    public function getAllErrors() : array
    {
        $errors = $this->getErrors();

        foreach ($this->components as $component) {
            $errors = array_merge($errors, $component->getErrors());
        }

        return $errors;
    }

    /**
     * @return Translator|null
     */
    public function getTranslator() : ?Translator
    {
        return $this->translator;
    }

    /**
     * @param Translator $translator
     *
     * @return Form
     */
    public function setTranslator(Translator $translator) : Form
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * Returns a non-decorated version of this form.
     *
     * All fields are concatenated in the order they have been registered.
     */
    public function __toString() : string
    {
        $output = $this->open();

        foreach ($this->components as $component) {
            $output .= (string) $component;
        }

        $output .= $this->close();

        return $output;
    }
}
