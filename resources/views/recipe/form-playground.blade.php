<fieldset class="mb-3">
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
                    {{ __("Playground") }}
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="withLifecycle" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-withLifecycle"
                    name="withLifecycle"
                    value="1"
                    {{ old("withLifecycle") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-withLifecycle">
                    <i class="fa-solid fa-arrows-spin"></i>
                    {{ __("withLifecycle") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="withMatrix" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-withMatrix"
                    name="withMatrix"
                    value="1"
                    {{ old("withMatrix") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-withMatrix">
                    <i class="fa-solid fa-square-binary"></i>
                    {{ __("withMatrix") }}
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="withPermissions" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-withPermissions"
                    name="withPermissions"
                    value="1"
                    {{ old("withPermissions") ? "checked" : "" }}
                />
                <label
                    class="form-check-label"
                    for="form-input-withPermissions"
                >
                    <i class="fa-solid fa-shield-halved"></i>
                    {{ __("withPermissions") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="withPlanning" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-withPlanning"
                    name="withPlanning"
                    value="1"
                    {{ old("withPlanning") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-withPlanning">
                    <i class="fa-solid fa-calendar-check"></i>
                    {{ __("withPlanning") }}
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="withPublishing" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-withPublishing"
                    name="withPublishing"
                    value="1"
                    {{ old("withPublishing") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-withPublishing">
                    <i class="fa-solid fa-book"></i>
                    {{ __("withPublishing") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="withStatus" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-withStatus"
                    name="withStatus"
                    value="1"
                    {{ old("withStatus") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-withStatus">
                    <i class="fa-solid fa-gears"></i>
                    {{ __("withStatus") }}
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="withRevisions" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-withRevisions"
                    name="withRevisions"
                    value="1"
                    {{ old("withRevisions") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-withRevisions">
                    <i class="fa-solid fa-book"></i>
                    {{ __("withRevisions") }}
                </label>
            </div>
        </div>
    </div>
</fieldset>
