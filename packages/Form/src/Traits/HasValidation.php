<?php

namespace PrimeCMS\Form\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait HasValidation
{

    public function validate(Request|array $dataOrRequest): \Illuminate\Validation\Validator
    {
        if ($dataOrRequest instanceof Request) {
            $data = $dataOrRequest->input();
        } else {
            $data = $dataOrRequest;
        }

        return Validator::make($data, $this->getRules());
        
    }

    public function getRules()
    {
        $res = [];
        foreach ($this->schema as $field) {
            $res[$field->getName()] = $res->getRules();
        }
        return $res;
    }
}
