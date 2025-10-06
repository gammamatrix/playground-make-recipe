<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests;

/**
 * \Playground\Make\Recipe\Http\Requests\SaveRecipeRequest
 */
class SaveRecipeRequest extends FormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [
        'description' => ['nullable', 'string'],
        'title' => ['nullable', 'string'],
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
