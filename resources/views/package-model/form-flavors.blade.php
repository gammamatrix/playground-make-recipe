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
                        @if (in_array('circlet', $recipe->flavors()))
                        <option
                            value="circlet"
                            @if (in_array('circlet', old("flavors"))) selected @endif
                        >
                            {{ __("Circlet") }}
                        </option>
                        @endif
                        @if (in_array('parent', $recipe->flavors()))
                        <option
                            value="parent"
                            @if (in_array('parent', old("flavors"))) selected @endif
                        >
                            {{ __("Parents") }}
                        </option>
                        @endif
                        @if (in_array('playground', $recipe->flavors()))
                        <option
                            value="playground"
                            @if (in_array('playground', old("flavors"))) selected @endif
                        >
                            {{ __("Playground") }}
                        </option>
                        @endif
                        @if (in_array('revision', $recipe->flavors()))
                        <option
                            value="revision"
                            @if (in_array('revision', old("flavors"))) selected @endif
                        >
                            {{ __("Revisions") }}
                        </option>
                        @endif
                        @if (in_array('routing', $recipe->flavors()))
                        <option
                            value="routing"
                            @if (in_array('routing', old("flavors"))) selected @endif
                        >
                            {{ __("Routing") }}
                        </option>
                        @endif
                        @if (in_array('tags', $recipe->flavors()))
                            <option
                                value="tags"
                                @if (in_array('tags', old("flavors"))) selected @endif
                            >
                                {{ __("Tags") }}
                            </option>
                        @endif
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
