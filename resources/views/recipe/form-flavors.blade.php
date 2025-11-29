<fieldset class="mb-3">
    <legend>{{ __("Flavors") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.flavor.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Flavor") }}
        </a>
    </div>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Flavor</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->flavors() as $flavor)
                <tr>
                    <td>
                        {{ $flavor }}
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.flavor.form", ["recipe_slug" => $recipe_slug, "flavor" => $flavor]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete-disabled"
                            href="{{ route("playground.make.recipe.flavor.delete", ["recipe_slug" => $recipe_slug, "flavor" => $flavor]) }}"
                            data-bs-toggle="modal-disabled"
                            data-bs-target="#modal-recipe-delete"
                        >
                            <i class="fas fa-close"></i>
                            Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</fieldset>
