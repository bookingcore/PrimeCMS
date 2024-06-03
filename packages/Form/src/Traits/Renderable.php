<?php

namespace PrimeCMS\Form\Traits;

use Illuminate\Support\HtmlString;
use PrimeCMS\Form\Enums\PositionEnum;

trait Renderable
{

    public function renderPosition(PositionEnum $enum)
    {
        $fields = $this->getFieldsIn($enum);
        $html = "";

        foreach ($fields as $field) {
            $html .= $this->renderField($field);
        }

        return new HtmlString($html);

    }

    public function renderField($field)
    {
        $field = $this->getField($field);
        if ($field) {
            return $field->render();
        }
    }

    public function render()
    {
        $this->setup();
        return new HtmlString(view('primecms/form::form', [
            "form" => $this
        ])->render());
    }


}
