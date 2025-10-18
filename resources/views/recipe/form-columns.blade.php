<fieldset class="mb-3">
    <legend>{{ __("Columns") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.column.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Column") }}
        </a>
    </div>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Column</th>
                <th>Label</th>
                <th>Description</th>
                <th>Index</th>
                <th>Nullable</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->columns() as $column => $column)
                <tr>
                    <td>
                        {{ $column->column() }}
                    </td>
                    <td>
                        {{ $column->label() }}
                    </td>
                    <td>
                        {{ $column->description() }}
                    </td>
                    <td>
                        @if ($column->index())
                            <i class="fa-solid fa-address-book text-info"></i>
                        @endif
                    </td>
                    <td>
                        @if ($column->nullable())
                            <i
                                class="fa-solid fa-ban fa-rotate-90 text-warning"
                            ></i>
                        @endif
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.column.form", ["recipe_slug" => $recipe_slug, "column" => $column_slug]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete"
                            href="{{ route("playground.make.recipe.column.delete", ["recipe_slug" => $recipe_slug, "column" => $column_slug]) }}"
                            data-bs-toggle="modal"
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
