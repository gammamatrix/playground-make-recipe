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
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
