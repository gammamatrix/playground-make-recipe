@extends("playground::layouts.site")

<?php
//$packageModel_slug =
//    ! empty($packageModel) &&
//    $packageModel instanceof \Playground\Make\Recipe\Configuration\PackageModel
//        ? $packageModel->type()
//        : "";
//if ($packageModel_slug) {
//    $title = "Package Model Form";
//} else {
//    $title = "Edit: " . $packageModel_slug;
//}
$title = "Package Model Form";
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
                    <a
                        href="{{ route("playground.make.recipe.form", ["recipe_slug" => $recipe->slug()]) }}"
                    >
                        {{ $recipe->title() }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a
                        href="{{ route("playground.make.recipe.package-model.form", ["recipe_slug" => $recipe->slug(), "packageModel" => $packageModel_slug]) }}"
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
                <form
                    method="POST"
                    action="{{ route("playground.make.recipe.package-model.save", ["recipe_slug" => $recipe_slug, "slug" => $packageModel_slug]) }}"
                    class="needs-validation"
                    novalidate
                >
                    @csrf

                    <input
                        type="hidden"
                        name="_return_url"
                        value="{{ $_return_url }}"
                    />

                    @include("playground-make-recipe::package-model/form-info")
                    @include("playground-make-recipe::package-model/form-playground")
                    @include("playground-make-recipe::package-model/form-grammar")
                    @include("playground-make-recipe::package-model/form-flavors")
                    @includeWhen($recipe->withRevisions(), "playground-make-recipe::package-model/form-revision")

                    <fieldset class="mb-3">
                        <div class="button-group float-end">
                            <button type="submit" class="btn btn-primary">
                                {{ __("Save") }}
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
