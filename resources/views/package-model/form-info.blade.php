<form
    method="POST"
    action="{{ route("playground.make.recipe.package-model.save", ["recipe_slug" => $recipe_slug, "slug" => $packageModel_slug]) }}"
    class="needs-validation"
    novalidate
>
    @csrf

    <input type="hidden" name="_return_url" value="{{ $_return_url }}" />

    <fieldset class="mb-3 fieldset-basic" id="fieldset-info">
        <legend>{{ __("Information") }}</legend>

        <div class="row">
            <div class="col">
                <x-playground::forms.column
                    column="model"
                    label="Model"
                    :autocomplete="false"
                    :rules="[
                        'required' => true,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
            <div class="col">
                <x-playground::forms.column
                    column="description"
                    label="Description"
                    :autocomplete="false"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
            {{-- <div class="col"> --}}
            {{-- <div class=""> --}}
            {{-- <div class="input-group my-3"> --}}
            {{-- <label class="input-group-text" for="form-input-type"> --}}
            {{-- Type --}}
            {{-- </label> --}}
            {{-- <select --}}
            {{-- id="form-input-type" --}}
            {{-- class="form-select @error("type") is-invalid @enderror" --}}
            {{-- value="{{ old("type") }}" --}}
            {{-- name="type" --}}
            {{-- > --}}
            {{-- <option --}}
            {{-- value="flag" --}}
            {{-- @if ('flag' === old("type")) selected @endif --}}
            {{-- > --}}
            {{-- {{ __("Flag") }} --}}
            {{-- </option> --}}
            {{-- </select> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- </div> --}}
            {{-- <div class="col"> --}}
            {{-- <x-playground::forms.column --}}
            {{-- column="value" --}}
            {{-- label="Value" --}}
            {{-- :autocomplete="false" --}}
            {{-- :rules="[ --}}
            {{-- 'required' => false, --}}
            {{-- 'maxlength' => 255, --}}
            {{-- ]" --}}
            {{-- ></x-playground::forms.column> --}}
            {{-- </div> --}}
        </div>
    </fieldset>

    <fieldset class="mb-3">
        <div class="button-group float-end">
            <button type="submit" class="btn btn-primary">
                {{ __("Save") }}
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
