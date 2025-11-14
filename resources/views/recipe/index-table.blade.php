<table class="table table-responsive">
    <thead>
        <tr>
            <th>Recipe</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($recipes as $recipe)
            <tr>
                <td>
                    <a
                        href="{{ route("playground.make.recipe.form", ["recipe_slug" => $recipe]) }}"
                    >
                        {{ $recipe }}
                    </a>
                </td>
                <td>
                    <a
                        class="btn btn-success"
                        href="{{ route("playground.make.recipe.form", ["recipe_slug" => $recipe]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>
                    <a
                        class="btn btn-danger confirm-delete"
                        href="{{ route("playground.make.recipe.delete", ["recipe_slug" => $recipe]) }}"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-recipe-delete"
                    >
                        <i class="fas fa-close"></i>
                        Delete
                    </a>
                    <a
                        class="btn btn-warning"
                        href="{{ route("playground.make.recipe.configuration", ["recipe_slug" => $recipe, "_return_url" => route("playground.make.recipe")]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Configuration
                    </a>
                    <a
                        class="btn btn-warning"
                        href="{{ route("playground.make.recipe.source", ["recipe_slug" => $recipe, "asPhp" => 1, "_return_url" => route("playground.make.recipe")]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Source:
                        <code>php</code>
                    </a>
                    <a
                        class="btn btn-warning"
                        href="{{ route("playground.make.recipe.source", ["recipe_slug" => $recipe, "_return_url" => route("playground.make.recipe")]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Source:
                        <code>phps</code>
                    </a>
                    <a
                        class="btn btn-info"
                        href="{{ route("playground.make.recipe.copy", ["recipe_slug" => $recipe]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Copy
                    </a>
                    <a
                        class="btn btn-info"
                        href="{{ route("playground.make.recipe.command", ["recipe_slug" => $recipe, "command" => "package", "type" => "playground-api"]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Command: API
                    </a>
                    <a
                        class="btn btn-info"
                        href="{{ route("playground.make.recipe.command", ["recipe_slug" => $recipe, "command" => "package", "type" => "playground-resource"]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Command: Resource
                    </a>
                    <a
                        class="btn btn-info"
                        href="{{ route("playground.make.recipe.command", ["recipe_slug" => $recipe, "command" => "package", "type" => "playground-model"]) }}"
                    >
                        <i class="fas fa-edit"></i>
                        Command: Model
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
