<?php
$withSize = ! empty($withSize);
?>

<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Information") }}</legend>

    <x-playground::forms.column
        column="column"
        label="Column"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="label"
        label="Label"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="description"
        label="Description"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    @if ($withSize)
        <x-playground::forms.column
            column="size"
            label="Size"
            type="number"
            :autocomplete="false"
            :rules="[
                'required' => false,
                'min' => 0,
            ]"
        ></x-playground::forms.column>
    @endif
</fieldset>
