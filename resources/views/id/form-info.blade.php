<form
    method="POST"
    action="{{ route("playground.make.recipe.id.save", ["recipe_slug" => $recipe_slug, "id" => $id_slug]) }}"
    class="needs-validation"
    novalidate
>
    @csrf

    <input type="hidden" name="_return_url" value="{{ $_return_url }}" />

    @section("form-info-end")
    <div class="mb-3">
        <label for="form-input-type" class="form-label">
            Choose or type an option
        </label>
        <input
            class="form-control"
            list="options-column-types"
            id="form-input-type"
            name="type"
            placeholder="Type or select..."
            required
            maxlength="255"
            value="{{ old('type') }}"
        />
        <datalist id="options-column-types">
            <option value="uuid"></option>
            <option value="ulid"></option>
            <option value="string"></option>
            <option value="char"></option>
            <option value="dateTime"></option>
            <option value="integer"></option>
            <option value="bigInteger"></option>
            <option value="mediumInteger"></option>
            <option value="smallInteger"></option>
            <option value="tinyInteger"></option>
        </datalist>
    </div>
    @endsection

    @include("playground-make-recipe::io.form-info", ["withLabel" => true, "withColumn" => true, "withSize" => true, "withType" => false])

    @include("playground-make-recipe::io.form-defaults")

    @include("playground-make-recipe::io.form-options")
    @include("playground-make-recipe::io.form-indexes", ["withUnique" => true])

    @include("playground-make-recipe::id.form-has-one")

    <div class="row">
        <div class="col-md-6">
            @include("playground-make-recipe::io.form-exclude")
        </div>
        <div class="col-md-6">
            @include("playground-make-recipe::io.form-only")
        </div>
    </div>

    <fieldset class="mb-3">
        <div class="button-group float-end">
            <button type="submit" class="btn btn-primary">
                {{ __("Save") }}
            </button>
            <button type="reset" class="btn btn-warning">
                {{ __("Reset") }}
            </button>
            <a class="btn btn-danger" href="{{ $_return_url }}">
                {{ __("Cancel") }}
            </a>
        </div>
    </fieldset>
</form>
