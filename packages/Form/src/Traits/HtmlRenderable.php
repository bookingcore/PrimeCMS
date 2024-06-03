<?php

namespace PrimeCMS\Form\Traits;

use Illuminate\Support\HtmlString;

trait HtmlRenderable
{
    /**
     * Build an HTML attribute string from an array.
     *
     * @param array $attributes
     *
     * @return string
     */
    public function attributesHtml($attributes)
    {
        $html = [];

        foreach ((array)$attributes as $key => $value) {
            $element = $this->attributeElementHtml($key, $value);

            if (!is_null($element)) {
                $html[] = $element;
            }
        }

        return new HtmlString(count($html) > 0 ? ' ' . implode(' ', $html) : '');
    }

    /**
     * Build a single attribute element.
     *
     * @param string $key
     * @param string $value
     *
     * @return string
     */
    protected function attributeElementHtml($key, $value)
    {
        // For numeric keys we will assume that the value is a boolean attribute
        // where the presence of the attribute represents a true value and the
        // absence represents a false value.
        // This will convert HTML attributes such as "required" to a correct
        // form instead of using incorrect numerics.
        if (is_numeric($key)) {
            return $value;
        }

        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key !== 'value') {
            return $value ? $key : '';
        }

        if (is_array($value) && $key === 'class') {
            return 'class="' . implode(' ', $value) . '"';
        }

        if (!is_null($value)) {
            return $key . '="' . e($value, false) . '"';
        }
    }
}
