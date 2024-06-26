<?php

namespace PrimeCMS\Form;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use PrimeCMS\Form\Enums\PositionEnum;
use PrimeCMS\Form\Fields\BaseField;
use PrimeCMS\Form\Traits\HasModel;
use PrimeCMS\Form\Traits\HasValidation;
use PrimeCMS\Form\Traits\Renderable;

class BaseForm implements Htmlable
{
    use HasValidation;
    use Renderable;
    use HasModel;

    /**
     * @var Collection BaseField
     */
    protected Collection $schema;

    protected Model $model;

    public function __construct()
    {
        $this->schema = collect();
    }

    /**
     * Add Field
     *
     * @param $name
     * @param $type
     * @param $options
     * @return $this
     */
    public function add($name, $type, $options = [])
    {
        $default = [
            "position" => PositionEnum::NORMAL,
            "priority" => 10
        ];

        $fieldData = [
            "name"    => $name,
            "type"    => $type,
            "options" => array_merge($default, $options)
        ];

        $this->schema->add($this->getField($fieldData));

        return $this;
    }

    /**
     * Remove by name
     *
     * @param $name
     * @return $this
     */
    public function remove($name)
    {
        $this->schema = $this->schema->reject(function ($item) use ($name) {
            return $item->getName() === $name;
        });
        return $this;
    }

    public function when($condition, \Closure $closure)
    {
        if ($condition) {
            $closure->call($this);
        }
    }

    /**
     * Safe to start build form
     *
     * @return void
     */
    public function setup()
    {
    }

    protected function getFieldsIn(PositionEnum $enum)
    {
        return $this->schema->where(function ($item) use ($enum) {
            return $item->getPosition() === $enum;
        })->all();
    }

    protected function getField($field): BaseField
    {
        $type = $field['type'];
        if (array_key_exists($type, config('primecms/form.fields'))) {
            $class = config('primecms/form.fields')[$type];
        } else {
            $class = $type;
        }

        if (!class_exists($class)) {
            throw new \Exception("Field type does not exist: " . $class);
        }

        return app()->make($class, [
            "field" => $field,
            "form"  => $this
        ]);
    }

    public function toHtml()
    {
        return $this->render();
    }

}
