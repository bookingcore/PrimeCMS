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
            "position" => PositionEnum::SIDE
        ]);
    }
}
