<form
    method="POST"
    action="{{ route("playground.make.recipe.column.save", ["recipe_slug" => $recipe_slug, "column" => $column_slug]) }}"
    class="needs-validation"
    novalidate
>
    @csrf

    <input type="hidden" name="_return_url" value="{{ $_return_url }}" />

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

        <div class="row">
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="index" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="form-input-index"
                        name="index"
                        value="1"
                        {{ old("index") ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="form-input-index">
                        <i class="fa-solid fa-address-book text-info"></i>
                        {{ __("index") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="nullable" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="form-input-nullable"
                        name="nullable"
                        value="1"
                        {{ old("nullable") ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="form-input-nullable">
                        <i
                            class="fa-solid fa-ban fa-rotate-90 text-warning"
                        ></i>
                        {{ __("nullable") }}
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="readOnly" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="form-input-readOnly"
                        name="readOnly"
                        value="1"
                        {{ old("readOnly") ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="form-input-readOnly">
                        <i
                            class="fa-solid fa-pen text-warning"
                            data-fa-transform="shrink-10 up-.5"
                            data-fa-mask="fa-solid fa-ban"
                        ></i>
                        {{ __("read only") }}
                    </label>
                </div>
            </div>
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
