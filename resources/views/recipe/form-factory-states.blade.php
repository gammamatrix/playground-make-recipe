<fieldset class="mb-3">
    <legend>{{ __("Factory States") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.factory-state.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Factory State") }}
        </a>
    </div>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>State</th>
                <th>Type</th>
                <th>Description</th>
                <th>Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->factoryStates() as $state => $factoryState)
                <tr>
                    <td>
                        {{ $factoryState->state() }}
                    </td>
                    <td>
                        {{ $factoryState->type() }}
                    </td>
                    <td>
                        {{ $factoryState->description() }}
                    </td>
                    <td>
                        {{ json_encode($factoryState->value()) }}
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.factory-state.form", ["recipe_slug" => $recipe_slug, "slug" => $state]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete-disabled"
                            href="{{ route("playground.make.recipe.factory-state.delete", ["recipe_slug" => $recipe_slug, "slug" => $state]) }}"
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
