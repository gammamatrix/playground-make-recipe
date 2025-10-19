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
                <th>Type</th>
                <th>Description</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recipe->factoryStates() as $column => $factoryState)
                <tr>
                    <td>
                        {{ $factoryState->type() }}
                    </td>
                    <td>
                        {{ $factoryState->label() }}
                    </td>
                    <td>
                        {{ $factoryState->description() }}
                    </td>
                    <td>
                        @if ($factoryState->icon())
                            <i class="{{ $factoryState->icon() }}"></i>
                        @endif
                    </td>
                    <td>
                        @if ($factoryState->index())
                            <i class="fa-solid fa-address-book text-info"></i>
                        @endif
                    </td>
                    <td>
                        @if ($factoryState->nullable())
                            <i
                                class="fa-solid fa-ban fa-rotate-90 text-warning"
                            ></i>
                        @endif
                    </td>
                    <td>
                        @if ($factoryState->readOnly())
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
                        <a
                            class="btn btn-success"
                            href="{{ route("playground.make.recipe.factoryState.form", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
                        >
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <a
                            class="btn btn-danger confirm-delete"
                            href="{{ route("playground.make.recipe.factoryState.delete", ["recipe_slug" => $recipe_slug, "column" => $column]) }}"
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
