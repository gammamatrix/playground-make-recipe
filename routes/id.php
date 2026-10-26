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
    'prefix' => 'make/{recipe_slug}/id',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/form/{column?}', [
        'as' => 'playground.make.recipe.id.form',
        'uses' => 'IdController@form',
    ]);

    Route::post('/form/{column?}', [
        'as' => 'playground.make.recipe.id.save',
        'uses' => 'IdController@save',
    ]);

    Route::get('/recipe/delete/{column?}', [
        'as' => 'playground.make.recipe.id.delete',
        'uses' => 'IdController@delete',
    ]);
});
