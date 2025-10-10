<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests;

/**
 * \Playground\Make\Recipe\Http\Requests\SaveRecipeRequest
 */
class DeleteModelRequest extends FormRequest
{
    public const array RULES = [
        'description' => ['nullable', 'string'],
        'title' => ['nullable', 'string'],
    ];
}
