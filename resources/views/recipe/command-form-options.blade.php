<fieldset class="mb-3 fieldset-basic" id="fieldset-info">
    <legend>{{ __("Package") }}</legend>

    <div class="row">
        <div class="col">
            <x-playground::forms.column
                column="class"
                label="Class"
                :autocomplete="false"
                :rules="[
                    'required' => false,
                    'maxlength' => 255,
                ]"
            ></x-playground::forms.column>
        </div>
        <div class="col"></div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="all" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-all"
                    name="all"
                    value="1"
                    {{ old("all") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-all">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("All") }}
                </label>
            </div>
        </div>
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
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="force" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-force"
                    name="force"
                    value="1"
                    {{ old("force") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-force">
                    <i class="fa-solid fa-play text-danger"></i>
                    {{ __("Force") }}
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="covers" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-covers"
                    name="covers"
                    value="1"
                    {{ old("covers") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-covers">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("Covers") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="factories" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-factories"
                    name="factories"
                    value="1"
                    {{ old("factories") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-factories">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("Factories") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="skeleton" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-skeleton"
                    name="skeleton"
                    value="1"
                    {{ old("skeleton") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-skeleton">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("Skeleton") }}
                </label>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="migrations" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-migrations"
                    name="migrations"
                    value="1"
                    {{ old("migrations") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-migrations">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("Migrations") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="models" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-models"
                    name="models"
                    value="1"
                    {{ old("models") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-models">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("Models") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="test" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-test"
                    name="test"
                    value="1"
                    {{ old("test") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-test">
                    <i class="fa-solid fa-play text-success"></i>
                    {{ __("Test") }}
                </label>
            </div>
        </div>
        <div class="col">
            <div class="form-check form-check-inline">
                <input type="hidden" name="revision" value="0" />
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="form-input-revision"
                    name="revision"
                    value="1"
                    {{ old("revision") ? "checked" : "" }}
                />
                <label class="form-check-label" for="form-input-revision">
                    <i class="fa-solid fa-ban fa-rotate-90 text-warning"></i>
                    {{ __("revision") }}
                </label>
            </div>
        </div>
    </div>
</fieldset>
