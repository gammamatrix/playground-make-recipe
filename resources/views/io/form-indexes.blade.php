<?php
$withUnique = ! empty($withUnique);
?>

<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Indexes") }}</legend>
    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="index" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-index"
                    name="index"
                    value="1"
                    {{ old("index") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-index">
                    <i class="fa-solid fa-address-book text-info"></i>
                    {{ __("index") }}
                </label>
            </div>
        </div>
        @if ($withUnique)
            <div class="col">
                <div class="form-check form-check-inline">
                    <input type="hidden" name="unique" value="0" />
                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="form-input-unique"
                        name="unique"
                        value="1"
                        {{ old("unique") ? "checked" : "" }}
                    />
                    <label class="form-check-label" for="form-input-unique">
                        <i class="fa-solid fa-fingerprint"></i>
                        {{ __("unique") }}
                    </label>
                </div>
            </div>
        @endif
    </div>
</fieldset>
