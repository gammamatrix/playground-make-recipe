<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Column;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Column\FormRecipeRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'column' => ['required', 'string'],
        'type' => ['required', 'string'],
        'description' => ['nullable', 'string'],
        'label' => ['nullable', 'string'],
        'index' => ['boolean'],
        'unique' => ['boolean'],
        'nullable' => ['boolean'],
        'html' => ['boolean'],
        'hasDefault' => ['boolean'],
        'default' => ['nullable', 'string'],
        'precision' => ['nullable', 'integer', 'min:1', 'max:65'],
        'scale' => ['nullable', 'integer', 'min:0', 'max:30'],
        'size' => ['nullable', 'integer', 'min:0'],
        '_return_url' => ['nullable', 'string'],
    ];

    protected function prepareForValidation()
    {
        $merge = [];

        if ($this->has('description') && empty($this->input('description'))) {
            $merge['description'] = '';
        }

        if ($this->has('label') && empty($this->input('label'))) {
            $merge['label'] = '';
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }
}
