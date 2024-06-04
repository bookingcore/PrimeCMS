<?php

namespace App;

use PrimeCMS\Form\BaseForm;
use PrimeCMS\Form\Enums\PositionEnum;

class TestForm extends BaseForm
{

    public function setup()
    {
        $this->add("title", "text", [
            "rules"    => 'required',
            "label"    => "xxx",
            "position" => PositionEnum::NORMAL,
            "value"    => 1
        ]);
        $this->add("s", "select", [
            "rules"    => 'required',
            "label"    => "xxx",
            "position" => PositionEnum::NORMAL,
            "value"    => 1,
            "options"  => [
                ["id" => 1, "text" => 2],
                ["id" => 2, "text" => 3],
            ]
        ]);
        $this->add("s", "select", [
            "rules"    => 'required',
            "label"    => "xxx",
            "position" => PositionEnum::NORMAL,
            "value"    => [1, 2],
            "options"  => [
                ["id" => 1, "text" => 2],
                ["id" => 2, "text" => 3],
            ],
            'multiple' => true
        ]);
        $this->add("s", "radio", [
            "rules"    => 'required',
            "label"    => "xxx",
            "position" => PositionEnum::NORMAL,
            "value"    => 1,
            "options"  => [
                ["id" => 1, "text" => 2],
                ["id" => 2, "text" => 3],
            ]
        ]);
        $this->add("s", "checkbox", [
            "rules"    => 'required',
            "label"    => "xxx",
            "position" => PositionEnum::NORMAL,
            "value"    => 1,
            "options"  => [
                ["id" => 1, "text" => 2],
                ["id" => 2, "text" => 3],
            ]
        ]);
        $this->add("s", "checklist", [
            "rules"    => 'required',
            "label"    => "xxx",
            "position" => PositionEnum::NORMAL,
            "value"    => [1, 2],
            "options"  => [
                ["id" => 1, "text" => 2],
                ["id" => 2, "text" => 3],
                ["id" => 3, "text" => 4],
            ],
            "multiple" => true
        ]);
        $this->add("title1", "textarea", [
            "rules"    => 'required',
            "label"    => "xxx",
            "position" => PositionEnum::SIDE,
            "value"    => 2
        ]);
    }
}
