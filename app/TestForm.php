<?php

namespace App;

use PrimeCMS\Form\BaseForm;

class TestForm extends BaseForm
{

    public function setup()
    {
        $this->add("title", "text", [
            "rules" => 'required'
        ]);
    }
}
