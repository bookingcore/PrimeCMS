<?php

namespace PrimeCMS\Form\Traits;

use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use PrimeCMS\Form\Enums\PositionEnum;
use PrimeCMS\Form\Fields\BaseField;

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

    public function renderField(BaseField $field)
    {
        $res = $field->render();
        if ($res instanceof View) {
            return $res->render();
        }
        return $res;
    }

    public function render()
    {
        $this->setup();
        return new HtmlString(view('primecms/form::form', [
            "form" => $this
        ])->render());
    }

    public function __toString(): string
    {
        return $this->render();
    }

}
