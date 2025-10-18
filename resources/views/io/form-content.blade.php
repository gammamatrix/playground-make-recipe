<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Content") }}</legend>
    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="html" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-html"
                    name="html"
                    value="1"
                    {{ old("html") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-html">
                    <i class="fa-brands fa-html5"></i>
                    {{ __("uses HTML") }}
                </label>
            </div>
        </div>
    </div>
</fieldset>
