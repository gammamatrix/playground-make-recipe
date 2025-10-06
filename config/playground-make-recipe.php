<?php

/**
 * Playground
 */

declare(strict_types=1);

/**
 * Playground Make Configuration and Environment Variables
 *
 * @return array{
 *        about: bool,
 *        layout: string,
 *        load: array{
 *            routes: bool,
 *            translations: bool,
 *            views: bool
 *        },
 *        middleware: array{
 *            default: string|string[],
 *            auth: string|string[],
 *            guest: string|string[]
 *        },
 *        redis: array{
 *            connection: string
 *        },
 *        routes: array{
 *            form: bool,
 *        },
 *        blade: string,
 *        abilities: array<string, string[]>,
 *        sitemap: array{
 *             enable: bool,
 *             guest: bool,
 *             user: bool,
 *             view: string
 *        }
 *    }
 */
return [

    /*
    |--------------------------------------------------------------------------
    | About Information
    |--------------------------------------------------------------------------
    |
    | By default, information will be displayed about this package when using:
    |
    | `artisan about`
    |
    */

    'about' => (bool) env('PLAYGROUND_MAKE_RECIPE_ABOUT', true),

    /*
    |--------------------------------------------------------------------------
    | Loading
    |--------------------------------------------------------------------------
    |
    | By default, commands and translations are loaded.
    |
    */

    'load' => [
        'commands' => (bool) env('PLAYGROUND_MAKE_RECIPE_LOAD_COMMANDS', true),
        'routes' => (bool) env('PLAYGROUND_MAKE_RECIPE_LOAD_ROUTES', true),
        'translations' => (bool) env('PLAYGROUND_MAKE_RECIPE_LOAD_TRANSLATIONS', true),
        'views' => (bool) env('PLAYGROUND_MAKE_RECIPE_LOAD_VIEWS', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    |
    */

    'middleware' => [
        'default' => env('PLAYGROUND_MAKE_RECIPE_MIDDLEWARE_DEFAULT', ['web']),
        'auth' => env('PLAYGROUND_MAKE_RECIPE_MIDDLEWARE_AUTH', ['web', 'auth']),
        'guest' => env('PLAYGROUND_MAKE_RECIPE_MIDDLEWARE_GUEST', ['web']),
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis
    |--------------------------------------------------------------------------
    |
    |
    */

    'redis' => [
        'connection' => env('PLAYGROUND_MAKE_RECIPE_REDIS_CONNECTION', 'default'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes
    |--------------------------------------------------------------------------
    |
    |
    */

    'routes' => [
        'form' => (bool) env('PLAYGROUND_MAKE_RECIPE_ROUTES_FORM', true),
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    |
    |
    */

    'sitemap' => [
        'enable' => (bool) env('PLAYGROUND_MAKE_RECIPE_SITEMAP_ENABLE', true),
        'guest' => (bool) env('PLAYGROUND_MAKE_RECIPE_SITEMAP_GUEST', true),
        'user' => (bool) env('PLAYGROUND_MAKE_RECIPE_SITEMAP_USER', true),
        'view' => env('PLAYGROUND_MAKE_RECIPE_SITEMAP_VIEW', 'playground-make-recipe::sitemap'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Templates
    |--------------------------------------------------------------------------
    |
    |
    */

    'blade' => env('PLAYGROUND_MAKE_RECIPE_BLADE', 'playground-make-recipe::'),

    /*
    |--------------------------------------------------------------------------
    | Abilities
    |--------------------------------------------------------------------------
    |
    |
    */

    'abilities' => [
        'admin' => [
            'playground-make-recipe:*',
        ],
        'manager' => [
            'playground-make-recipe:command:*',
            'playground-make-recipe:form:*',
        ],
        'user' => [
            'playground-make-recipe:command:view',
            'playground-make-recipe:command:viewAny',
            'playground-make-recipe:form:view',
            'playground-make-recipe:form:viewAny',
        ],
    ],
];
