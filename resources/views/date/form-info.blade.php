<form
    method="POST"
    action="{{ route("playground.make.recipe.date.save", ["recipe_slug" => $recipe_slug, "column" => $date_slug]) }}"
    class="needs-validation"
    novalidate
>
    @csrf

    <input type="hidden" name="_return_url" value="{{ $_return_url }}" />

    @include("playground-make-recipe::io.form-info")
    @include("playground-make-recipe::io.form-indexes")
    @include("playground-make-recipe::io.form-defaults")

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
