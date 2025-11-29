<fieldset class="mb-3">
    <legend>{{ __("Json Columns") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.json.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Json Column") }}
        </a>
    </div>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Column</th>
                <th>Type</th>
                <th>Label</th>
                <th>Comment</th>
                <th>Description</th>
                <th>Nullable</th>
                <th>Default</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->json() as $column => $json)
                <tr>
                    <td>
                        {{ $json->column() }}
                    </td>
                    <td>
                        {{ $json->type() }}
                    </td>
                    <td>
                        {{ $json->label() }}
                    </td>
                    <td>
                        {{ $json->comment() }}
                    </td>
                    <td>
                        {{ $json->description() }}
                    </td>
                    <td>
                        @if ($json->nullable())
                            <i
                                class="fa-solid fa-ban fa-rotate-90 text-warning"
                            ></i>
                        @endif
                    </td>
                    <td>
                        <code>{{ $json->default() }}</code>
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.json.form", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete-disabled"
                            href="{{ route("playground.make.recipe.json.delete", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
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
