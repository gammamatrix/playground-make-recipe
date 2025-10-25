<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Flavor;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Flavor\SaveRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'flavor' => ['required', 'string'],
        '_return_url' => ['nullable', 'string'],
    ];
}
