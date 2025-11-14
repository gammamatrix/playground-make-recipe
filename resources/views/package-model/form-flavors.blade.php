<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Flavors") }}</legend>

    <div class="row">
        <div class="col">
            <div class="">
                <div class="input-group my-3">
                    <label class="input-group-text" for="form-input-flavors">
                        Choices
                    </label>
                    <select
                        id="form-input-flavors"
                        multiple
                        class="form-select @error("flavors") is-invalid @enderror"
                        name="flavors[]"
                    >
                        <option
                            value="parent"
                            @if (in_array('parent', old("flavors"))) selected @endif
                        >
                            {{ __("Parents") }}
                        </option>
                        <option
                            value="playground"
                            @if (in_array('playground', old("flavors"))) selected @endif
                        >
                            {{ __("Playground") }}
                        </option>
                        <option
                            value="revision"
                            @if (in_array('revision', old("flavors"))) selected @endif
                        >
                            {{ __("Revisions") }}
                        </option>
                        <option
                            value="routing"
                            @if (in_array('routing', old("flavors"))) selected @endif
                        >
                            {{ __("Routing") }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
