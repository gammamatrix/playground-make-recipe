<fieldset class="mb-3">
    <legend>{{ __("Package Models") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.package-model.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Package Model") }}
        </a>
    </div>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->packageModels() as $className => $packageModel)
                <tr>
                    <td>
                        {{ $packageModel->model() }}
                    </td>
                    <td>
                        {{ $packageModel->description() }}
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.package-model.form", ["recipe_slug" => $recipe_slug, "slug" => $className]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete"
                            href="{{ route("playground.make.recipe.package-model.delete", ["recipe_slug" => $recipe_slug, "slug" => $className]) }}"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-recipe-delete"
                        >
                            <i class="fas fa-close"></i>
                            Delete
                        </a>
                        <a
                            class="btn btn-warning"
                            href="{{ route("playground.make.recipe.package-model.form", ["recipe_slug" => $recipe_slug, "slug" => $className]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Defaults
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</fieldset>
