<form
    method="POST"
    action="{{ route("playground.make.recipe.json.save", ["recipe_slug" => $recipe_slug, "column" => $json_slug]) }}"
    class="needs-validation"
    novalidate
>
    @csrf

    <input type="hidden" name="_return_url" value="{{ $_return_url }}" />

    @include("playground-make-recipe::io.form-info", ["withLabel" => true, "withColumn" => true, "withSize" => false])

    @include("playground-make-recipe::io.form-defaults")
    @include("playground-make-recipe::io.form-options", ["withReadOnly" => true, "withIcon" => false])

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
