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

        'class' => ['nullable', 'string'],
        'email' => ['nullable', 'string'],
        'license' => ['nullable', 'string'],
        'module' => ['nullable', 'string'],
        'slug' => ['nullable', 'string'],
        'namespace' => ['nullable', 'string'],
        'organization' => ['nullable', 'string'],
        'package' => ['nullable', 'string'],
        'packagist' => ['nullable', 'string'],
        'type' => ['nullable', 'string'],
        'package-version' => ['nullable', 'string'],
        'migration_date' => ['nullable', 'string', 'regex:/^[0-9]{4}_[0-9]{2}_[0-9]{2}$/'],
        'migration_order' => ['nullable', 'string', 'regex:/^[a-zA-Z0-9]+$/'],

        'all' => ['boolean'],
        'covers' => ['boolean'],
        'factories' => ['boolean'],
        'force' => ['boolean'],
        'migrations' => ['boolean'],
        'models' => ['boolean'],
        'playground' => ['boolean'],
        'revision' => ['boolean'],
        'skeleton' => ['boolean'],
        'test' => ['boolean'],

        '_return_url' => ['nullable', 'string'],
    ];
}
