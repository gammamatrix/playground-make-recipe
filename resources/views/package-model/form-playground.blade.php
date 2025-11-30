<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Playground") }}</legend>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="playground" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-playground"
                    name="playground"
                    value="1"
                    {{ old("playground") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-playground">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("playground") }}
                </label>
            </div>
        </div>
    </div>
</fieldset>
