<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Only") }}</legend>

    <div class="row">
        <div class="col">
            <div class="">
                <div class="input-group my-3">
                    <label class="input-group-text" for="form-input-only">
                        Choices
                    </label>
                    <select
                        id="form-input-only"
                        multiple
                        class="form-select @error("only") is-invalid @enderror"
                        name="only[]"
                        size="{{ count($recipe->packageModels()) }}"
                    >
                        @foreach ($recipe->packageModels() as $modelNameClass => $packageModel)
                            <option
                                value="{{ $packageModel->model() }}"
                                @if (in_array($packageModel->model(), old("only") ?? [])) selected @endif
                            >
                                {{ __($packageModel->model_label() ?: $packageModel->model()) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</fieldset>
