<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Information") }}</legend>

    @if ($command === "package")
        <div class="row">
            <div class="col">
                <x-playground::forms.column
                    column="email"
                    label="Email"
                    :autocomplete="true"
                    type="email"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
            <div class="col">
                <x-playground::forms.column
                    column="organization"
                    label="Organization"
                    :autocomplete="true"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <x-playground::forms.column
                column="package"
                label="Package"
                :autocomplete="false"
                :rules="[
                    'required' => true,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
        <div class="col">
            <x-playground::forms.column
                column="module"
                label="Module"
                :autocomplete="true"
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
                column="namespace"
                label="Namespace"
                :autocomplete="true"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
        @if ($command === "package")
            <div class="col">
                <x-playground::forms.column
                    column="packagist"
                    label="Packagist"
                    :autocomplete="true"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
        @endif

        <div class="col">
            <x-playground::forms.column
                column="github"
                label="Github"
                :autocomplete="true"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
    </div>

    @if ($command === "package")
        <div class="row">
            <div class="col">
                <x-playground::forms.column
                    column="license"
                    label="License"
                    :autocomplete="true"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
            <div class="col">
                <x-playground::forms.column
                    column="package_version"
                    label="Package version"
                    :autocomplete="true"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
        </div>
    @endif

    @if ($command === "model")
        <div class="row">
            <div class="col">
                <x-playground::forms.column
                    column="migration_date"
                    label="Migration Date"
                    :autocomplete="true"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
            <div class="col">
                <x-playground::forms.column
                    column="migration_order"
                    label="Migration Order"
                    :autocomplete="true"
                    :rules="[
                        'required' => false,
                        'maxlength' => 255,
                    ]"
                ></x-playground::forms.column>
            </div>
        </div>
    @endif
</fieldset>
