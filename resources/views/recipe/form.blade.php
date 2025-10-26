@extends("playground::layouts.site")

<?php
$recipe_slug =
    ! empty($recipe) &&
    $recipe instanceof \Playground\Make\Recipe\Configuration\Recipe
        ? $recipe->slug()
        : "";
if ($recipe_slug) {
    $title = "Recipe Form";
} else {
    $title = "Edit: " . $recipe_slug;
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
                <li class="breadcrumb-item">
                    <a href="{{ route("playground.make.recipe.form") }}">
                        Form
                    </a>
                </li>
                @if ($recipe->slug())
                    <li class="breadcrumb-item active" aria-current="page">
                        <a
                            href="{{ route("playground.make.recipe.form", ["recipe_slug" => $recipe->slug()]) }}"
                        >
                            Edit: {{ $recipe->title() ?: $recipe->slug() }}
                        </a>
                    </li>
                @endif
            </ol>
        </nav>
    </div>
@endsection

@section("form-info-start")
    <x-playground::forms.column
        column="class"
        label="Class"
        :autocomplete="false"
        :rules="[
            'required' => false,
            'maxlength' => 255,
        ]"
    ></x-playground::forms.column>
@endsection

@section("content")
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include("playground-make-recipe::recipe/form-info")
            </div>
        </div>
        @if ($recipe->slug())
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include("playground-make-recipe::recipe/form-models")
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include("playground-make-recipe::recipe/form-columns")
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include("playground-make-recipe::recipe/form-dates")
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include("playground-make-recipe::recipe/form-flags")
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include("playground-make-recipe::recipe/form-json-columns")
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include("playground-make-recipe::recipe/form-flavors")
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include("playground-make-recipe::recipe/form-factory-states")
                </div>
            </div>
        @endif
    </div>
@endsection

@push("body")
    <script type="application/javascript">
        window.onload = function () {
            'use strict';
            // if (typeof playground === 'object') {
            //     playground.forms.editor('#form-input-content');
            // }
            if (typeof playground === 'object') {
                playground.forms.validation();
            }
        };
    </script>
@endpush

@include("playground-make-recipe::recipe/index-modal-delete")
