<?php

/**
 * Playground
 */

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Make Recipe Routes
|--------------------------------------------------------------------------
|
|
*/

Route::group([
    'prefix' => 'make/{recipe_slug}/package-model',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/form/{slug?}', [
        'as' => 'playground.make.recipe.package-model.form',
        'uses' => 'PackageModelController@form',
    ]);

    Route::post('/form/{slug?}', [
        'as' => 'playground.make.recipe.package-model.save',
        'uses' => 'PackageModelController@save',
    ]);

    Route::get('/recipe/delete/{slug?}', [
        'as' => 'playground.make.recipe.package-model.delete',
        'uses' => 'PackageModelController@delete',
    ]);
});
