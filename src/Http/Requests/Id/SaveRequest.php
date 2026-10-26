<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Id;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Id\SaveRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'accessor' => ['required', 'string'],
        'column' => ['required', 'string'],
        'comment' => ['nullable', 'string'],
        'foreign_key' => ['required', 'string'],
        'local_key' => ['required', 'string'],
        'on' => ['required', 'string'],
        'related' => ['required', 'string'],
        'references' => ['required', 'string'],
        'type' => ['required', 'string'],
        'description' => ['nullable', 'string'],
        'icon' => ['nullable', 'string'],
        'label' => ['nullable', 'string'],
        'index' => ['boolean'],
        'unique' => ['boolean'],
        'nullable' => ['boolean'],
        'hasDefault' => ['boolean'],
        'default' => ['nullable', 'string'],
        'size' => ['nullable', 'integer', 'min:0'],
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

        if ($this->has('icon') && empty($this->input('icon'))) {
            $merge['icon'] = '';
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
