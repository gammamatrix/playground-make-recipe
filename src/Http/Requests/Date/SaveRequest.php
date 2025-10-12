<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Requests\Date;

use Illuminate\Validation\Validator;
use Playground\Make\Recipe\Http\Requests\FormRequest;

/**
 * \Playground\Make\Recipe\Http\Requests\Date\FormRecipeRequest
 */
class SaveRequest extends FormRequest
{
    public const array RULES = [
        'column' => ['required', 'string'],
        'description' => ['nullable', 'string'],
        'label' => ['nullable', 'string'],
        'index' => ['boolean'],
        'nullable' => ['boolean'],
        '_return_url' => ['nullable', 'string'],
    ];

    protected function prepareForValidation()
    {
        $merge = [];

        if ($this->has('description') && empty($this->input('description'))) {
            $merge['description'] = '';
        }

        if ($this->has('label') && empty($this->input('label'))) {
            $merge['label'] = '';
        }

        if (! empty($merge)) {
            $this->merge($merge);
        }
        //            dd([
        //                '__METHOD__' => __METHOD__,
        //                '$this->input()' => $this->input(),
        //                '$this->has(description)' => $this->has('description'),
        //                '$this->has(label)' => $this->has('label'),
        //            ]);
    }
    //
    //    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    //    {
    //        dd([
    //            '__METHOD__' => __METHOD__,
    //            '$this->input()' => $this->input(),
    //            '$validator' => $validator,
    //        ]);
    //        $exception = $validator->getException();
    //
    //        throw new $exception($validator);
    //    }

}
