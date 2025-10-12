<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Recipe;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Recipe\SaveRecipeRequest
 */
class FormRecipeRequest extends FormRequest
{
    public const array RULES = [
        'description' => ['nullable', 'string'],
        'title' => ['nullable', 'string'],
        'slug' => ['nullable', 'string'],
        '_return_url' => ['nullable', 'string'],
    ];
}
