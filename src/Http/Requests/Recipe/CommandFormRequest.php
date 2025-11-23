<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Recipe;

use Playground\Make\Recipe\Http\Requests\FormRequest as BaseFormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Recipe\CommandFormRequest
 */
class CommandFormRequest extends BaseFormRequest
{
    public const array RULES = [
        'command' => ['nullable', 'string'],
        'model' => ['nullable', 'string'],
        'type' => ['nullable', 'string'],
        '_return_url' => ['nullable', 'string'],
    ];
}
