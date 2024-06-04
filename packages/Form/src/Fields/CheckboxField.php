<?php

namespace PrimeCMS\Form\Fields;

class CheckboxField extends BaseField
{

    public function render()
    {
        $data = [
            'name'        => $this->name,
            'value'       => $this->getValue(),
            'label'       => $this->getOption("label"),
            'placeholder' => $this->getOption("placeholder"),
            'attrs'       => $this->attributesHtml($this->getAttrs()),
            'options'     => $this->getOption("options", []),
            "isMultiple"  => $this->isMultiple(),
            "id"          => $this->getId()
        ];
        return view('primecms/form::fields.checkbox', $data);
    }

}
