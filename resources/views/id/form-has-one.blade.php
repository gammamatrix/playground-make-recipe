<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Has One") }}</legend>

    <x-playground::forms.column
        column="comment"
        label="Comment"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="local_key"
        label="Local Key"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="accessor"
        label="Accessor"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="related"
        label="Related"
        default="\Playground\Models\User"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="foreign_key"
        label="Foreign Key"
        default="id"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="references"
        label="References"
        default="id"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>

    <x-playground::forms.column
        column="on"
        label="On"
        default="users"
        :autocomplete="false"
        :rules="[
            'required' => true,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>
</fieldset>
