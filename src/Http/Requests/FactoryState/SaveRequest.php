<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\FactoryState;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\FactoryState\SaveRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'state' => ['required', 'string', 'regex:/^[a-z][a-zA-Z0-9]+$/'],
        'type' => ['required', 'string', 'in:flag'],
        'description' => ['nullable', 'string'],
        'value' => ['sometimes'],
        '_return_url' => ['nullable', 'string'],
    ];

    protected function prepareForValidation()
    {
        $merge = [];

        if ($this->has('description') && empty($this->input('description'))) {
            $merge['description'] = '';
        }

        if ($this->has('value') && empty($this->input('value'))) {
            $merge['value'] = $this->input('value');
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }
}
