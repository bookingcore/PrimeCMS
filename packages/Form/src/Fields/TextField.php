<?php

namespace PrimeCMS\Form\Fields;

class TextField extends BaseField
{

    public function render()
    {
        $data = [
            'name'        => $this->name,
            'value'       => $this->getValue(),
            'label'       => $this->getOption("label"),
            'inputType'   => $this->getOption("inputType", "text"),
            'placeholder' => $this->getOption("placeholder"),
            'attrs'       => $this->attributesHtml($this->getAttrs())
        ];
        return view('primecms/form::fields.text', $data)->render();
    }

}
