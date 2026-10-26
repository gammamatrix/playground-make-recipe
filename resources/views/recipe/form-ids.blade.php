<fieldset class="mb-3">
    <legend>{{ __("Ids") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.id.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Id") }}
        </a>
    </div>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Id</th>
                <th>Label</th>
                <th>Type</th>
                <th>Accessor</th>
                <th>Foreign key</th>
                <th>Local key</th>
                <th>On</th>
                <th>Related</th>
                <th>Comment</th>
                <th>Description</th>
                <th>Index</th>
                <th>Nullable</th>
                <th>Exclusive</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->ids() as $column => $id)
                <tr>
                    <td>
                        {{ $id->column() }}
                    </td>
                    <td>
                        {{ $id->label() }}
                    </td>
                    <td>
                        {{ $id->type() }}
                        @if (

                            in_array($id->type(), [
                                "integer",
                                "tinyInteger",
                                "smallInteger",
                                "mediumInteger",
                                "bigInteger"
                            ]) && $id->unsigned()                        )
                            <br />
                            <code>unsigned</code>
                        @endif
                    </td>
                    <td>
                        {{ $id->accessor() }}
                    </td>
                    <td>
                        {{ $id->foreign_key() }}
                    </td>
                    <td>
                        {{ $id->local_key() }}
                    </td>
                    <td>
                        {{ $id->on() }}
                    </td>
                    <td>
                        {{ $id->related() }}
                    </td>
                    <td>
                        {{ $id->comment() }}
                    </td>
                    <td>
                        {{ $id->description() }}
                    </td>
                    <td>
                        @if ($id->index())
                            <i class="fa-solid fa-address-book text-info"></i>
                        @endif
                    </td>
                    <td>
                        @if ($id->nullable())
                            <i
                                class="fa-solid fa-ban fa-rotate-90 text-warning"
                            ></i>
                        @endif
                    </td>
                    <td>
                        @if (! empty($id->exclude()))
                            <strong>Exclude:</strong>
                            {{ implode(", ", $id->exclude()) }}
                        @endif

                        @if (! empty($id->only()))
                            <strong>Only:</strong>
                            {{ implode(", ", $id->only()) }}
                        @endif
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.id.form", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete-disabled"
                            href="{{ route("playground.make.recipe.id.delete", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
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
