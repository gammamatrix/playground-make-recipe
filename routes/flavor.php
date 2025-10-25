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
    'prefix' => 'make/{recipe_slug}/flavor',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/form/{flavor?}', [
        'as' => 'playground.make.recipe.flavor.form',
        'uses' => 'FlavorController@form',
    ]);

    Route::post('/form/{flavor?}', [
        'as' => 'playground.make.recipe.flavor.save',
        'uses' => 'FlavorController@save',
    ]);

    Route::get('/recipe/delete/{flavor?}', [
        'as' => 'playground.make.recipe.flavor.delete',
        'uses' => 'FlavorController@delete',
    ]);
});
