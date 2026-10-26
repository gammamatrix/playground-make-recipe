@extends("playground::layouts.site")

<?php
$id_slug =
    ! empty($id) &&
    $id instanceof \Playground\Make\Recipe\Configuration\Id
        ? $id->column()
        : "";
if ($id_slug) {
    $title = "Id Form";
} else {
    $title = "Edit: " . $id_slug;
}
?>

@section("title", $title)

@section("breadcrumbs")
    <div class="container-fluid mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route("playground.make.recipe") }}">MAKE</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a
                        href="{{ route("playground.make.recipe.id.form", ["recipe_slug" => $recipe->slug(), "id" => $id_slug]) }}"
                    >
                        Form
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
                @include("playground-make-recipe::id/form-info")
            </div>
        </div>
    </div>
@endsection

@push("body-last")
    <script type="application/javascript">
        window.onload = function () {
            'use strict';
            if (typeof playground === 'object') {
                playground.forms.validation();
            }
        };
    </script>
@endpush
