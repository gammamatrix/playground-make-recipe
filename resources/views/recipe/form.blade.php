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
                @include("playground-make-recipe::recipe/form-info")
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
