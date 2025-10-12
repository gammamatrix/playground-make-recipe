<fieldset class="mb-3">
    <legend>{{ __("Dates") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.date.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Date") }}
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
            @foreach ($recipe->dates() as $column => $date)
                <tr>
                    <td>
                        {{ $date->column() }}
                    </td>
                    <td>
                        {{ $date->label() }}
                    </td>
                    <td>
                        {{ $date->description() }}
                    </td>
                    <td>
                        @if ($date->index())
                            <i class="fa-solid fa-address-book text-info"></i>
                        @endif
                    </td>
                    <td>
                        @if ($date->nullable())
                            <i
                                class="fa-solid fa-ban fa-rotate-90 text-warning"
                            ></i>
                        @endif
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.date.form", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete"
                            href="{{ route("playground.make.recipe.date.delete", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
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
