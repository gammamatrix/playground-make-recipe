<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Numbers") }}</legend>
    <div class="row">
        <div class="col">
            <x-playground::forms.column
                column="precision"
                label="Precision"
                type="number"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'min' => 0,
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
