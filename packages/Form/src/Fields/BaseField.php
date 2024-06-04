<?php

namespace PrimeCMS\Form\Fields;

use PrimeCMS\Form\BaseForm;
use PrimeCMS\Form\Enums\PositionEnum;
use PrimeCMS\Form\Helpers\RulesParser;
use PrimeCMS\Form\Traits\HtmlRenderable;

abstract class BaseField
{
    use HtmlRenderable;

    protected $name;

    protected $options = [];

    protected BaseForm $form;

    public function __construct($field, BaseForm $form)
    {
        $this->name = $field['name'];
        $this->options = $field['options'];
        $this->form = $form;
    }

    public function getValue()
    {
        $std = $this->getOption('std');
        $valueOption = $this->getOption('value');
        $value = $valueOption !== null ? $valueOption : $std;

        if ($value === null) {
            // Try from model
            $model = $this->form->getModel();
            if ($model) {
                $value = $model->getAttribute($this->name);
            }
        }


        // TODO add a way to disable use of "old" method
        return old($this->name, $value);

    }

    public function getOption($key, $default = null)
    {
        return $this->options[$key] ?? $default;
    }

    public function setValue($value)
    {
        $this->options[$value] = $value;
    }

    abstract function render();

    /**
     * Get all other attributes need to render
     * @return array
     */
    public function getAttrs()
    {
        $attrs = [];

        $rules = $this->getRules();
        if (!empty($rules)) {
            $rulesParser = app()->makeWith(RulesParser::class, [
                'field' => $this
            ]);
            $attrs += $rulesParser->parse($rules);
        }
        return $attrs;
    }

    public function getRules()
    {
        return $this->getOption('rules', []);
    }

    public function getId()
    {
        return $this->getOption('id', $this->name);
    }

    public function isMultiple()
    {
        return $this->getOption('multiple');
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPosition(): PositionEnum
    {
        return $this->getOption('position');
    }
}
