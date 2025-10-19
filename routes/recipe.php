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
    'prefix' => 'make',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/', [
        'as' => 'playground.make.recipe',
        'uses' => 'RecipeController@index',
    ]);

    Route::get('/form/{recipe_slug?}', [
        'as' => 'playground.make.recipe.form',
        'uses' => 'RecipeController@form',
    ]);

    Route::post('/form/{recipe_slug?}', [
        'as' => 'playground.make.recipe.save',
        'uses' => 'RecipeController@save',
    ]);

    Route::get('/recipe/load/{recipe_slug?}', [
        'as' => 'playground.make.recipe.load',
        'uses' => 'RecipeController@load',
    ]);

    Route::get('/recipe/write/{recipe_slug}', [
        'as' => 'playground.make.recipe.write',
        'uses' => 'RecipeController@write',
    ]);

    Route::get('/recipe/delete/{recipe_slug?}', [
        'as' => 'playground.make.recipe.delete',
        'uses' => 'RecipeController@delete',
    ]);
});
