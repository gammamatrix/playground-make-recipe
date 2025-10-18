<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Options") }}</legend>
    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="readOnly" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-readOnly"
                    name="readOnly"
                    value="1"
                    {{ old("readOnly") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-readOnly">
                    <i
                        class="fa-solid fa-pen text-warning"
                        data-fa-transform="shrink-10 up-.5"
                        data-fa-mask="fa-solid fa-ban"
                    ></i>
                    {{ __("read only") }}
                </label>
            </div>
        </div>
    </div>
</fieldset>
