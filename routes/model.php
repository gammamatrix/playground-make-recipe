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
    'prefix' => 'make/{recipe}/model',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/', [
        'as' => 'playground.make.recipe.model',
        'uses' => 'ModelController@index',
    ]);

    Route::get('/form/{slug?}', [
        'as' => 'playground.make.recipe.model.form',
        'uses' => 'ModelController@form',
    ]);

    Route::get('/recipe/delete/{slug?}', [
        'as' => 'playground.make.recipe.model.delete',
        'uses' => 'ModelController@delete',
    ]);
});
