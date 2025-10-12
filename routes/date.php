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
    'prefix' => 'make/{recipe_slug}/date',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/', [
        'as' => 'playground.make.recipe.date',
        'uses' => 'DateController@index',
    ]);

    Route::get('/form/{column?}', [
        'as' => 'playground.make.recipe.date.form',
        'uses' => 'DateController@form',
    ]);

    Route::post('/form/{column?}', [
        'as' => 'playground.make.recipe.date.save',
        'uses' => 'DateController@save',
    ]);

    Route::get('/recipe/delete/{column?}', [
        'as' => 'playground.make.recipe.date.delete',
        'uses' => 'DateController@delete',
    ]);
});
