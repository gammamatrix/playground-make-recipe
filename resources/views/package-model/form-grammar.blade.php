<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Information") }}</legend>

    <div class="row">
        <div class="col">
            <x-playground::forms.column
                column="model_singular"
                label="model: singular"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
        <div class="col">
            <x-playground::forms.column
                column="model_plural"
                label="model: plural"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <x-playground::forms.column
                column="model_slug"
                label="model: slug"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
        <div class="col">
            <x-playground::forms.column
                column="model_slug_plural"
                label="model: slug plural"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
    </div>
</fieldset>
