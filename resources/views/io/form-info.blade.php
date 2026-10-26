<?php
$withColumn = ! empty($withColumn);
$withDescription = ! isset($withDescription) || ! empty($withDescription);
$withExtends = ! empty($withExtends);
$withLabel = ! empty($withLabel);
$withSize = ! empty($withSize);
$withSlug = ! empty($withSlug);
$withTitle = ! empty($withTitle);
$withType = ! empty($withType);
?>

<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Information") }}</legend>

    @yield("form-info-start")

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

    @if ($withType)
        <div class="mb-3">
            <label for="form-input-type" class="form-label">
                Choose or type an option
            </label>
            <input
                class="form-control"
                list="options-column-types"
                id="form-input-type"
                name="type"
                placeholder="Type or select..."
                required
                maxlength="255"
                value="{{ old('type') }}"
            />
            <datalist id="options-column-types">
                <option value="string"></option>
                <option value="char"></option>
                <option value="smallText"></option>
                <option value="mediumText"></option>
                <option value="text"></option>
                <option value="longText"></option>
                <option value="boolean"></option>
                <option value="dateTime"></option>
                <option value="integer"></option>
                <option value="bigInteger"></option>
                <option value="mediumInteger"></option>
                <option value="smallInteger"></option>
                <option value="tinyInteger"></option>
                <option value="decimal"></option>
                <option value="float"></option>
                <option value="uuid"></option>
                <option value="ulid"></option>
            </datalist>
        </div>
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

    @yield("form-info-end")
</fieldset>
