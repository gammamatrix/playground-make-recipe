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

    Route::get('/command/{recipe_slug?}', [
        'as' => 'playground.make.recipe.command-form',
        'uses' => 'RecipeController@commandForm',
    ]);

    Route::post('/command/{recipe_slug}', [
        'as' => 'playground.make.recipe.command',
        'uses' => 'RecipeController@command',
    ]);

    Route::get('/copy/{recipe_slug?}', [
        'as' => 'playground.make.recipe.copy-form',
        'uses' => 'RecipeController@copyForm',
    ]);

    Route::post('/copy/{recipe_slug}', [
        'as' => 'playground.make.recipe.copy',
        'uses' => 'RecipeController@copy',
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

    Route::get('/recipe/configuration/{recipe_slug}', [
        'as' => 'playground.make.recipe.configuration',
        'uses' => 'RecipeController@saveConfiguration',
    ]);

    Route::get('/recipe/source/{recipe_slug}', [
        'as' => 'playground.make.recipe.source',
        'uses' => 'RecipeController@saveSource',
    ]);

    Route::get('/recipe/delete/{recipe_slug?}', [
        'as' => 'playground.make.recipe.delete',
        'uses' => 'RecipeController@delete',
    ]);
});
