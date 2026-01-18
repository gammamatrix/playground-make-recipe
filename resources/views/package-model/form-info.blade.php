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
</fieldset>
