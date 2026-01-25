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
 *        },
 *        defaults: array{
 *             email: string,
 *             github: string,
 *             organization: string,
 *             namespace: string,
 *             license: string,
 *             package-version: string,
 *             covers: bool,
 *             factories: bool,
 *             force: bool,
 *             migrations: bool,
 *             models: bool,
 *             playground: bool,
 *             skeleton: bool,
 *             test: bool
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

    /*
    |--------------------------------------------------------------------------
    | Command Generation Defaults
    |--------------------------------------------------------------------------
    |
    |
    */

    'defaults' => [
        'email' => env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_EMAIL', 'jeremy.postlethwaite@gmail.com'),
        'github' => env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_GITHUB', 'gammamatrix'),
        'organization' => env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_ORGANIZATION', 'Playground'),
        'namespace' => env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_NAMESPACE', 'Playground'),
        'license' => env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_LICENSE', 'MIT'),
        'package_version' => env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_PACKAGE_VERSION', '74.0.0'),

        'covers' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_COVERS', true),
        'factories' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_FACTORIES', true),
        'force' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_FORCE', true),
        'migrations' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_MIGRATIONS', true),
        'models' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_MODELS', true),
        'playground' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_PLAYGROUND', true),
        'skeleton' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_SKELETON', true),
        'test' => (bool) env('PLAYGROUND_MAKE_RECIPE_DEFAULTS_TEST', true),
    ],

];
