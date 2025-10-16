<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Column;

use Playground\Make\Recipe\Http\Requests\FormRequest as BaseFormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Column\FormRecipeRequest
 */
class FormRequest extends BaseFormRequest
{
    public const array RULES = [
        'column' => ['nullable', 'string'],
        'default' => ['nullable'],
        'description' => ['nullable', 'string'],
        'hasDefault' => ['boolean'],
        'html' => ['boolean'],
        'icon' => ['nullable', 'string'],
        'index' => ['boolean'],
        'label' => ['nullable', 'string'],
        'nullable' => ['boolean'],
        'precision' => ['nullable', 'integer', 'min:0', 'max:65'],
        'scale' => ['nullable', 'integer', 'min:0'],
        'size' => ['nullable', 'integer', 'min:0'],
        'readOnly' => ['boolean'],
        '_return_url' => ['nullable', 'string'],
    ];
}
