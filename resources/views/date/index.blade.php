@extends("playground::layouts.site")

@section("title", "MAKE")

@section("breadcrumbs")
    <div class="container-fluid mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route("playground.make.recipe") }}">MAKE</a>
                </li>
                <li class="breadcrumb-item">
                    <a
                        href="{{ route("playground.make.recipe.form", ["recipe_slug" => $recipe->slug()]) }}"
                    >
                        {{ $recipe->title() }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a
                        href="{{ route("playground.make.recipe.date", ["recipe_slug" => $recipe->slug()]) }}"
                    >
                        Dates
                    </a>
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
                        {{-- @include("playground-make-recipe::recipe/index-table") --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @include("playground-make-recipe::recipe/index-modal-delete") --}}
