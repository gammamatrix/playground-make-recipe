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
                        href="{{ route("playground.make.recipe.json.form", ["recipe_slug" => $recipe->slug(), "column" => $json_slug]) }}"
                    >
                        Form
                    </a>
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section("form-info-end")
    <fieldset class="mb-3">
        <legend>Type</legend>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="type"
                id="type_JSON_OBJECT"
                value="JSON_OBJECT"
                @if(old("type") === "JSON_OBJECT")checked @endif
            />
            <label class="form-check-label" for="type_JSON_OBJECT">
                <code>JSON_OBJECT</code>
            </label>
        </div>
        <div class="form-check">
            <input
                class="form-check-input"
                type="radio"
                name="type"
                id="type_JSON_ARRAY"
                value="JSON_ARRAY"
                @if(old("type") === "JSON_ARRAY")checked @endif
            />
            <label class="form-check-label" for="type_JSON_ARRAY">
                <code>JSON_ARRAY</code>
            </label>
        </div>
    </fieldset>

    <x-playground::forms.column
        column="comment"
        label="Comment"
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
                @include("playground-make-recipe::json/form-info")
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
