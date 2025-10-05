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
        'uses' => 'IndexController@index',
    ]);

});
