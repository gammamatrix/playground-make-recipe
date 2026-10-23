<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Numbers") }}</legend>
    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="unsigned" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-unsigned"
                    name="unsigned"
                    value="1"
                    {{ old("unsigned") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-unsigned">
                    <i class="fa-solid fa-minus text-warning"></i>
                    {{ __("unsigned") }}
                </label>
            </div>
        </div>
        <div class="col">
            <x-playground::forms.column
                column="precision"
                label="Precision"
                type="number"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'min' => 1,
                    'max' => 65,
                ]"
            ></x-playground::forms.column>
        </div>
        <div class="col">
            <x-playground::forms.column
                column="scale"
                label="Scale"
                type="number"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'min' => 0,
                    'max' => 30,
                ]"
            ></x-playground::forms.column>
        </div>
    </div>
</fieldset>
