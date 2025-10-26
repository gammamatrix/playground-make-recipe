<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Defaults") }}</legend>
    <div class="row">
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
                    <i class="fa-solid fa-ban fa-rotate-90 text-warning"></i>
                    {{ __("nullable") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                {{-- TODO not sure I will use hasDefault here --}}
                <input type="hidden" name="hasDefault" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-hasDefault"
                    name="hasDefault"
                    value="1"
                    {{ old("hasDefault") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-hasDefault">
                    <i class="fa-solid fa-lightbulb"></i>
                    {{ __("has default") }}
                </label>
            </div>
        </div>
        <div class="col">
            <x-playground::forms.column
                column="default"
                label="Default"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                ]"
            ></x-playground::forms.column>
        </div>
    </div>
</fieldset>
