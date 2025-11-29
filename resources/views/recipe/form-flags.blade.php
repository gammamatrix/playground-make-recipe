<fieldset class="mb-3">
    <legend>{{ __("Flags") }}</legend>

    <div class="button-group float-end mb-3">
        <a
            class="btn btn-success"
            href="{{ route("playground.make.recipe.flag.form", ["recipe_slug" => $recipe->slug()]) }}"
        >
            {{ __("Add Flag") }}
        </a>
    </div>

    <table class="table table-responsive">
        <thead>
            <tr>
                <th>Column</th>
                <th>Label</th>
                <th>Description</th>
                <th>Icon</th>
                <th>Index</th>
                <th>Nullable</th>
                <th>Read Only</th>
                <th>Default</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->flags() as $column => $flag)
                <tr>
                    <td>
                        {{ $flag->column() }}
                    </td>
                    <td>
                        {{ $flag->label() }}
                    </td>
                    <td>
                        {{ $flag->description() }}
                    </td>
                    <td>
                        @if ($flag->icon())
                            <i class="{{ $flag->icon() }}"></i>
                        @endif
                    </td>
                    <td>
                        @if ($flag->index())
                            <i class="fa-solid fa-address-book text-info"></i>
                        @endif
                    </td>
                    <td>
                        @if ($flag->nullable())
                            <i
                                class="fa-solid fa-ban fa-rotate-90 text-warning"
                            ></i>
                        @endif
                    </td>
                    <td>
                        @if ($flag->readOnly())
                            <i
                                class="fa-solid fa-pen text-warning"
                                data-fa-transform="shrink-10 up-.5"
                                data-fa-mask="fa-solid fa-ban"
                                data-fa-mask-id="comment"
                                style="background: MistyRose"
                            ></i>
                        @endif
                    </td>
                    <td>
                        {{ json_encode($flag->default()) }}
                    </td>
                    <td>
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.flag.form", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete-disabled"
                            href="{{ route("playground.make.recipe.flag.delete", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
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
