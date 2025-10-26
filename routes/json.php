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
    'prefix' => 'make/{recipe_slug}/json',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/form/{column?}', [
        'as' => 'playground.make.recipe.json.form',
        'uses' => 'JsonController@form',
    ]);

    Route::post('/form/{column?}', [
        'as' => 'playground.make.recipe.json.save',
        'uses' => 'JsonController@save',
    ]);

    Route::get('/recipe/delete/{column?}', [
        'as' => 'playground.make.recipe.json.delete',
        'uses' => 'JsonController@delete',
    ]);
});
