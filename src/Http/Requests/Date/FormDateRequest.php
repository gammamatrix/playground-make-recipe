<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Date;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Date\FormRecipeRequest
 */
class FormDateRequest extends FormRequest
{
    public const array RULES = [
        'column' => ['nullable', 'string'],
        'description' => ['nullable', 'string'],
        'label' => ['nullable', 'string'],
        'index' => ['boolean'],
        'nullable' => ['boolean'],
        '_return_url' => ['nullable', 'string'],
    ];
}
