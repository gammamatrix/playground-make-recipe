<?php
$withColumn = ! empty($withColumn);
$withDescription = ! isset($withDescription) || ! empty($withDescription);
$withExtends = ! empty($withExtends);
$withLabel = ! empty($withLabel);
$withSize = ! empty($withSize);
$withSlug = ! empty($withSlug);
$withTitle = ! empty($withTitle);
?>

<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Information") }}</legend>

    @if ($withTitle)
        <x-playground::forms.column
            column="title"
            label="Title"
            :autocomplete="false"
            :rules="[
                'required' => true,
                'maxlength' => 255,
            ]"
        ></x-playground::forms.column>
    @endif

    @if ($withColumn)
        <x-playground::forms.column
            column="column"
            label="Column"
            :autocomplete="false"
            :rules="[
                'required' => true,
                'maxlength' => 255,
            ]"
        ></x-playground::forms.column>
    @endif

    @if ($withSlug)
        <x-playground::forms.column
            column="slug"
            label="Slug"
            :autocomplete="false"
            :rules="[
                'required' => true,
                'maxlength' => 255,
            ]"
        ></x-playground::forms.column>
    @endif

    @if ($withLabel)
        <x-playground::forms.column
            column="label"
            label="Label"
            :autocomplete="false"
            :rules="[
                'required' => false,
                'maxlength' => 255,
            ]"
        ></x-playground::forms.column>
    @endif

    @if ($withDescription)
        <x-playground::forms.column
            column="description"
            label="Description"
            :autocomplete="false"
            :rules="[
                'required' => false,
                'maxlength' => 255,
            ]"
        ></x-playground::forms.column>
    @endif

    @if ($withExtends)
        <x-playground::forms.column
            column="extends"
            label="Extends"
            :autocomplete="false"
            :rules="[
                'required' => false,
                'maxlength' => 255,
            ]"
        ></x-playground::forms.column>
    @endif

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
