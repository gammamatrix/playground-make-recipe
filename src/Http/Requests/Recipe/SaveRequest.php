<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Recipe;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Recipe\SaveRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'class' => ['nullable', 'string'],
        'namespace' => ['nullable', 'string'],
        'description' => ['nullable', 'string'],
        'extends' => ['nullable', 'string'],
        'title' => ['nullable', 'string'],
        'slug' => ['nullable', 'string'],

        'playground' => ['boolean'],
        'withLifecycle' => ['boolean'],
        'withMatrix' => ['boolean'],
        'withPermissions' => ['boolean'],
        'withPlanning' => ['boolean'],
        'withPublishing' => ['boolean'],
        'withRevisions' => ['boolean'],
        'withStatus' => ['boolean'],

        '_return_url' => ['nullable', 'string'],
    ];
}
