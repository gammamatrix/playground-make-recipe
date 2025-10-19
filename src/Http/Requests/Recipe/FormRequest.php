<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Recipe;

use Playground\Make\Recipe\Http\Requests\FormRequest as BaseFormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Recipe\SaveRecipeRequest
 */
class FormRequest extends BaseFormRequest
{
    public const array RULES = [
        'description' => ['nullable', 'string'],
        'title' => ['nullable', 'string'],
        'slug' => ['nullable', 'string'],
        'extends' => ['nullable', 'string'],

        'playground' => ['boolean'],
        'withLifecycle' => ['boolean'],
        'withMatrix' => ['boolean'],
        'withPermissions' => ['boolean'],
        'withPlanning' => ['boolean'],
        'withPublishing' => ['boolean'],
        'withStatus' => ['boolean'],

        '_return_url' => ['nullable', 'string'],
    ];
}
