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
    'prefix' => 'make/{recipe_slug}/factory-state',
    'middleware' => config('playground-make-recipe.middleware.default'),
    'namespace' => '\Playground\Make\Recipe\Http\Controllers',
], function () {

    Route::get('/form/{slug?}', [
        'as' => 'playground.make.recipe.factory-state.form',
        'uses' => 'FactoryStateController@form',
    ]);

    Route::post('/form/{slug?}', [
        'as' => 'playground.make.recipe.factory-state.save',
        'uses' => 'FactoryStateController@save',
    ]);

    Route::get('/recipe/delete/{slug?}', [
        'as' => 'playground.make.recipe.factory-state.delete',
        'uses' => 'FactoryStateController@delete',
    ]);
});
