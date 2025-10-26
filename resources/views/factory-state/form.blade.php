@extends("playground::layouts.site")

<?php
//$factoryState_slug =
//    ! empty($factoryState) &&
//    $factoryState instanceof \Playground\Make\Recipe\Configuration\FactoryState
//        ? $factoryState->type()
//        : "";
//if ($factoryState_slug) {
//    $title = "Factory State Form";
//} else {
//    $title = "Edit: " . $factoryState_slug;
//}
$title = "Factory State Form";
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
                        href="{{ route("playground.make.recipe.factory-state.form", ["recipe_slug" => $recipe->slug(), "factoryState" => $factoryState_slug]) }}"
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
                @include("playground-make-recipe::factory-state/form-info")
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
