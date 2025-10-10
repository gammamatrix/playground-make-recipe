@extends("playground::layouts.site")

@section("title", "MAKE")

@section("breadcrumbs")
    <div class="container-fluid mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route("playground.make.recipe") }}">MAKE</a>
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-1">
                    <div class="card-header">
                        <h1>MAKE</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card m-1">
                                    <div class="card-body">
                                        <h5 class="card-title">Recipe</h5>
                                        <h6
                                            class="card-subtitle mb-2 text-muted"
                                        >
                                            Manage recipes
                                        </h6>
                                        <p class="card-text"></p>
                                        <a
                                            class="card-link"
                                            href="{{ route("playground.make.recipe.form") }}"
                                        >
                                            Recipe Form
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card my-1">
                    <div class="card-header">
                        <h1>Recipes</h1>
                    </div>
                    <div class="card-body">
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
                                                href="{{ route("playground.make.recipe.form", ["slug" => $recipe]) }}"
                                            >
                                                {{ $recipe }}
                                            </a>
                                        </td>
                                        <td>
                                            <a
                                                class="btn btn-success"
                                                href="{{ route("playground.make.recipe.form", ["slug" => $recipe]) }}"
                                            >
                                                <i class="fas fa-edit"></i>
                                                Edit
                                            </a>
                                            <a
                                                class="btn btn-danger confirm-delete"
                                                href="{{ route("playground.make.recipe.delete", ["slug" => $recipe]) }}"
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push("body")
    <div
        class="modal fade"
        id="modal-recipe-delete"
        tabindex="-1"
        aria-labelledby="modal-recipe-delete-label"
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-recipe-delete-label">
                        Confirm Deletion
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">Delete the recipe permanently!</div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Cancel
                    </button>
                    <a
                        id="action-confirm-delete"
                        href="#"
                        class="btn btn-danger"
                    >
                        Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
@endpush

@push("body")
    <script type="application/javascript">
        window.onload = function () {
            $('.confirm-delete').on('click', function (e) {
                e.preventDefault();

                const button_confirm_delete = $('#action-confirm-delete');

                if (button_confirm_delete) {
                    button_confirm_delete.attr('href', $(this).attr('href'));
                }
            });
        };
    </script>
@endpush
