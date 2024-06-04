<?php

namespace PrimeCMS\Form\Fields;

class TextareaField extends BaseField
{

    public function render()
    {
        $data = [
            'name'        => $this->name,
            'value'       => $this->getValue(),
            'label'       => $this->getOption("label"),
            'placeholder' => $this->getOption("placeholder"),
            'attrs'       => $this->attributesHtml($this->getAttrs())
        ];
        return view('primecms/form::fields.textarea', $data);
    }

}
