<form
    method="POST"
    action="{{ route("playground.make.recipe.copy", ["recipe_slug" => $recipe->slug() ?: null]) }}"
    class="needs-validation"
    novalidate
>
    @csrf

    <input type="hidden" name="_return_url" value="{{ $_return_url }}" />

    @include("playground-make-recipe::io/form-info", ["withExtends" => true, "withSlug" => true, "withTitle" => true])

    @include("playground-make-recipe::recipe/form-playground")

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
