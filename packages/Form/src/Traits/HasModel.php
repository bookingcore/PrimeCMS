<?php

namespace PrimeCMS\Form\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasModel
{
    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function getModel(): ?Model
    {
        return $this->model ?? null;
    }
}
