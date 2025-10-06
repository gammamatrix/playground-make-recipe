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
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route("playground.make.recipe.form") }}">
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
                <form
                    method="POST"
                    action="{{ route("playground.make.recipe.form") }}"
                    class="needs-validation"
                    novalidate
                >
                    @csrf

                    <input
                        type="hidden"
                        name="_return_url"
                        value="{{ $_return_url }}"
                    />

                    <fieldset class="mb-3 fieldset-basic" id="fieldset-info">
                        <legend>{{ __("Information") }}</legend>

                        <x-playground::forms.column
                            column="title"
                            label="Title"
                            :autocomplete="false"
                            :rules="[
                                'required' => true,
                                'maxlength' => 255,
                            ]"
                        ></x-playground::forms.column>
                    </fieldset>

                    <fieldset class="mb-3">
                        <div class="button-group float-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __("Submit") }}
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
