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
    'prefix' => 'make/{recipe_slug}/column',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/', [
        'as' => 'playground.make.recipe.column',
        'uses' => 'ColumnController@index',
    ]);

    Route::get('/form/{column_slug?}', [
        'as' => 'playground.make.recipe.column.form',
        'uses' => 'ColumnController@form',
    ]);

    Route::post('/form/{column_slug?}', [
        'as' => 'playground.make.recipe.column.save',
        'uses' => 'ColumnController@save',
    ]);

    Route::get('/recipe/delete/{column_slug?}', [
        'as' => 'playground.make.recipe.column.delete',
        'uses' => 'ColumnController@delete',
    ]);
});
