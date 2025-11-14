<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Recipe;

use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Recipe\CommandRequest
 */
class CommandRequest extends FormRequest
{
    public const array RULES = [
        'command' => ['nullable', 'string'],

        'email' => ['nullable', 'string'],
        'license' => ['nullable', 'string'],
        'module' => ['nullable', 'string'],
        'slug' => ['nullable', 'string'],
        'namespace' => ['nullable', 'string'],
        'organization' => ['nullable', 'string'],
        'package' => ['nullable', 'string'],
        'packagist' => ['nullable', 'string'],
        'type' => ['nullable', 'string'],
        'version' => ['nullable', 'string'],

        'playground' => ['boolean'],

        '_return_url' => ['nullable', 'string'],
    ];
}
