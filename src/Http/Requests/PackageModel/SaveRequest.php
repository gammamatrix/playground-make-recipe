<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\PackageModel;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\PackageModel\SaveRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'model' => ['required', 'string', 'regex:/^[A-Z][a-zA-Z0-9]+$/'],
        'model_fqdn' => ['nullable', 'string'],
        'migration_date' => ['nullable', 'string', 'regex:/^[0-9]{4}_[0-9]{2}_[0-9]{2}$/'],
        'migration_order' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9]+$/'],
        'model_column' => ['nullable', 'string'],
        'model_label' => ['nullable', 'string'],
        'model_attribute' => ['nullable', 'string'],
        'model_plural' => ['nullable', 'string'],
        'model_revision' => ['nullable', 'string'],
        'model_singular' => ['nullable', 'string'],
        'model_slug' => ['nullable', 'string'],
        'model_slug_plural' => ['nullable', 'string'],
        'name' => ['nullable', 'string'],
        'namespace' => ['nullable', 'string'],
        'organization' => ['nullable', 'string'],
        'description' => ['nullable', 'string'],
        'recipe' => ['nullable', 'string'],
        'table' => ['nullable', 'string'],
        'type' => ['nullable', 'string'],
        'playground' => ['boolean'],
        'revision' => ['boolean'],
        '_return_url' => ['nullable', 'string'],
        'flavors' => ['nullable', 'array'],
        'flavors.*' => ['string', 'distinct', 'in:parent,playground,revision,routing'],
    ];

    protected function prepareForValidation()
    {
        $merge = [];

        $strings = [
            'model_fqdn',
            'migration_date',
            'migration_order',
            'model_column',
            'model_label',
            'model_attribute',
            'model_plural',
            'model_revision',
            'model_singular',
            'model_slug',
            'model_slug_plural',
            'name',
            'namespace',
            'organization',
            'description',
            'recipe',
            'table',
            'type',
        ];

        foreach ($strings as $column) {
            if ($this->has($column) && empty($this->input($column))) {
                $merge[$column] = '';
            }
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
    }
}
