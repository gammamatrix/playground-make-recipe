<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\FactoryState;

use Playground\Make\Recipe\Http\Requests\FormRequest as BaseFormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\FactoryState\FormRequest
 */
class FormRequest extends BaseFormRequest
{
    public const array RULES = [
        //        'column' => ['nullable', 'string'],
        //        'default' => ['nullable'],
        //        'description' => ['nullable', 'string'],
        //        'icon' => ['nullable', 'string'],
        //        'index' => ['boolean'],
        //        'label' => ['nullable', 'string'],
        //        'nullable' => ['boolean'],
        //        'readOnly' => ['boolean'],
        '_return_url' => ['nullable', 'string'],
    ];
}
