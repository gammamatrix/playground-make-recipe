<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Information") }}</legend>

    <div class="row">
        <div class="col">
            <x-playground::forms.column
                column="model_revision"
                label="model: revision"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="revision" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-revision"
                    name="revision"
                    value="1"
                    {{ old("revision") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-revision">
                    <i class="fa-solid fa-ban fa-rotate-90 text-warning"></i>
                    {{ __("revision") }}
                </label>
            </div>
        </div>
    </div>
</fieldset>
