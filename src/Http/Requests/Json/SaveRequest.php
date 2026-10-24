<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Json;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Json\SaveRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'column' => ['required', 'string'],
        'comment' => ['nullable', 'string'],
        'default' => ['nullable', 'json'],
        'description' => ['nullable', 'string'],
        'type' => ['string', 'in:JSON_ARRAY,JSON_OBJECT'],
        'label' => ['nullable', 'string'],
        'nullable' => ['boolean'],
        'readOnly' => ['boolean'],
        'exclude' => ['array'],
        'exclude.*' => ['string', 'min:1', 'max:65', 'distinct'],
        'only' => ['array'],
        'only.*' => ['string', 'min:1', 'max:65', 'distinct'],
        '_return_url' => ['nullable', 'string'],
    ];

    protected function prepareForValidation()
    {
        $merge = [];

        if ($this->has('comment') && empty($this->input('comment'))) {
            $merge['comment'] = '';
        }

        if ($this->has('description') && empty($this->input('description'))) {
            $merge['description'] = '';
        }

        if ($this->has('label') && empty($this->input('label'))) {
            $merge['label'] = '';
        }

        if (! $this->has('exclude')) {
            $merge['exclude'] = [];
        }

        if (! $this->has('only')) {
            $merge['only'] = [];
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }
}
