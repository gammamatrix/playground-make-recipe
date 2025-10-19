<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Recipe;

use Playground\Make\Recipe\Http\Requests\FormRequest as BaseFormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Recipe\WriteRequest
 */
class WriteRequest extends BaseFormRequest
{
    public const array RULES = [
        'asPhp' => ['boolean'],
        '_return_url' => ['nullable', 'string'],
    ];
}
