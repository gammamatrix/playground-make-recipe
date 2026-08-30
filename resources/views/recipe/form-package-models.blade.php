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
                <th>Playground</th>
                <th>Revision</th>
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
                        @if ($packageModel->playground())
                            <i class="fa-solid fa-play text-success"></i>
                        @endif
                    </td>
                    <td>
                        @if ($packageModel->revision())
                            <i class="fa-solid fa-book"></i>
                        @elseif ($packageModel->model_revision())
                            {{ $packageModel->model_revision() }}
                        @endif
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
                            class="btn btn-danger confirm-delete-disabled"
                            href="{{ route("playground.make.recipe.package-model.delete", ["recipe_slug" => $recipe_slug, "slug" => $className]) }}"
                            data-bs-toggle="modal-disabled"
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
                        <a
                            class="btn btn-info"
                            href="{{ route("playground.make.recipe.command", ["recipe_slug" => $recipe_slug, "model" => $className, "command" => "model", "type" => $packageModel->type() ?: 'playground-model']) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Command: Model
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</fieldset>
