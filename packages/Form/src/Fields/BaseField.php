<?php

namespace PrimeCMS\Form\Fields;

use PrimeCMS\Form\BaseForm;
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
        $value = $this->getOption('value') !== null ?: $std;

        if ($value === null) {
            // Try from model
            $model = $this->form->getModel();
            if ($model) {
                $value = $model->getAttribute($this->name);
            }
        }

        return $value;

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
}
