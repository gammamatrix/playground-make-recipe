<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\FormRequest
 */
class FormRequest extends BaseFormRequest
{
    /**
     * @var array<string, string|array<mixed>>
     */
    public const RULES = [];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        if (empty($user)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return static::RULES;
    }
}
