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
    'prefix' => 'make/{recipe_slug}/flag',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/', [
        'as' => 'playground.make.recipe.flag',
        'uses' => 'FlagController@index',
    ]);

    Route::get('/form/{column?}', [
        'as' => 'playground.make.recipe.flag.form',
        'uses' => 'FlagController@form',
    ]);

    Route::post('/form/{column?}', [
        'as' => 'playground.make.recipe.flag.save',
        'uses' => 'FlagController@save',
    ]);

    Route::get('/recipe/delete/{column?}', [
        'as' => 'playground.make.recipe.flag.delete',
        'uses' => 'FlagController@delete',
    ]);
});
