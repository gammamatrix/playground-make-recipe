<form
    method="POST"
    action="{{ route("playground.make.recipe.save", ["slug" => $recipe->slug() ?: null]) }}"
    class="needs-validation"
    novalidate
>
    @csrf

    <input type="hidden" name="_return_url" value="{{ $_return_url }}" />

    <fieldset class="mb-3 fieldset-basic" id="fieldset-info">
        <legend>{{ __("Information") }}</legend>

        <x-playground::forms.column
            column="title"
            label="Title"
            :autocomplete="false"
            :rules="[
                'required' => true,
                'maxlength' => 255,
            ]"
        ></x-playground::forms.column>

        <x-playground::forms.column
            column="slug"
            label="Slug"
            :autocomplete="false"
            :rules="[
                'required' => true,
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
    </fieldset>

    <fieldset class="mb-3">
        <div class="button-group float-end">
            <button type="submit" class="btn btn-primary">
                {{ __("Submit") }}
            </button>
            <button type="reset" class="btn btn-warning">
                {{ __("Reset") }}
            </button>
            <a class="btn btn-danger" href="{{ $_return_url }}">
                {{ __("Cancel") }}
            </a>
        </div>
    </fieldset>
</form>
