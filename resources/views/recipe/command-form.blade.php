@extends("playground::layouts.site")

<?php
$recipe_slug =
    ! empty($recipe) &&
    $recipe instanceof \Playground\Make\Recipe\Configuration\Recipe
        ? $recipe->slug()
        : "";
$title = "Command: " . $recipe_slug;
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
                            Command: {{ $recipe->title() ?: $recipe->slug() }}
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
                <form
                    method="POST"
                    action="{{ route("playground.make.recipe.command", ["recipe_slug" => $recipe->slug() ?: null]) }}"
                    class="needs-validation"
                    novalidate
                >
                    @csrf

                    <input
                        type="hidden"
                        name="_return_url"
                        value="{{ $_return_url }}"
                    />
                    <input
                        type="hidden"
                        name="command"
                        value="{{ old("command") }}"
                    />
                    <input
                        type="hidden"
                        name="type"
                        value="{{ old("type") }}"
                    />

                    @include("playground-make-recipe::recipe/command-form-info")

                    <fieldset class="mb-3">
                        <div class="button-group float-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __("Generate") }}
                            </button>
                            <button type="reset" class="btn btn-warning">
                                {{ __("Reset") }}
                            </button>
                            <a
                                class="btn btn-danger"
                                href="{{ $_return_url }}"
                            >
                                {{ __("Cancel") }}
                            </a>
                        </div>
                    </fieldset>
                </form>
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

@include("playground-make-recipe::recipe/index-modal-delete")
