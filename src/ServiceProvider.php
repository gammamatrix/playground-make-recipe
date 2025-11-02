<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;
use Illuminate\Support\Facades\App;

/**
 * \Playground\Make\Recipe\ServiceProvider
 */
class ServiceProvider extends AuthServiceProvider
{
    public const string VERSION = '74.0.0';

    public string $package = 'playground-make-recipe';

    /**
     * Bootstrap any package services.
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        /**
         * @var array{
         *         about: bool,
         *         layout: string,
         *         load: array{
         *             routes: bool,
         *             translations: bool,
         *             views: bool
         *         },
         *         middleware: array{
         *             default: string|string[],
         *             auth: string|string[],
         *             guest: string|string[]
         *         },
         *         redis: array{
         *             connection: string
         *         },
         *         routes: array{
         *             form: bool,
         *         },
         *         blade: string,
         *         abilities: array<string, string[]>,
         *         sitemap: array{
         *              enable: bool,
         *              guest: bool,
         *              user: bool,
         *              view: string
         *         }
         *     } $config
         */
        $config = config($this->package);

        if (! empty($config['load']) && is_array($config['load'])) {

            if (! empty($config['load']['commands'])) {
                $this->boot_commands();
            }

            if (! empty($config['load']['translations'])) {
                $this->loadTranslationsFrom(
                    dirname(__DIR__).'/lang',
                    $this->package
                );
            }

            if (! empty($config['load']['routes'])
                && ! empty($config['routes'])
                && is_array($config['routes'])
            ) {
                $this->routes($config['routes']);
            }

            if (! empty($config['load']['views'])) {
                $this->loadViewsFrom(
                    dirname(__DIR__).'/resources/views',
                    $this->package
                );
            }

        }

        if (App::runningInConsole()) {
            // Publish configuration
            $this->publishes([
                sprintf('%1$s/config/%2$s.php', dirname(__DIR__), $this->package) => config_path(sprintf('%1$s.php', $this->package)),
            ], 'playground-config');

            // Publish routes
            $this->publishes([
                dirname(__DIR__).'/routes' => base_path('routes/playground-make-recipe'),
            ], 'playground-routes');
        }

        if (! empty($config['about'])) {
            $this->about();
        }
    }

    /**
     * @return array<int, class-string<GeneratorCommand>>
     */
    public function boot_commands(): array
    {
        $commands = [];

        $commands[] = Console\Commands\RecipeMakeCommand::class;

        $this->commands($commands);

        return $commands;
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__).'/config/playground-make-recipe.php',
            'playground-make-recipe'
        );
    }

    /**
     * @param  array<string, mixed>  $config
     */
    public function routes(array $config): void
    {
        if (! empty($config['form'])) {
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/column.php');
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/date.php');
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/factory-state.php');
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/flag.php');
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/flavor.php');
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/json.php');
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/package-model.php');
            $this->loadRoutesFrom(dirname(__DIR__).'/routes/recipe.php');
        }
    }

    public function about(): void
    {
        $config = config($this->package);
        $config = is_array($config) ? $config : [];

        $load = ! empty($config['load']) && is_array($config['load']) ? $config['load'] : [];

        $middleware = ! empty($config['middleware']) && is_array($config['middleware']) ? $config['middleware'] : [];

        $routes = ! empty($config['routes']) && is_array($config['routes']) ? $config['routes'] : [];

        $sitemap = ! empty($config['sitemap']) && is_array($config['sitemap']) ? $config['sitemap'] : [];

        AboutCommand::add('Playground: Make Recipe', fn () => [
            '<fg=yellow;options=bold>Load</> Commands' => ! empty($load['commands']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=yellow;options=bold>Load</> Routes' => ! empty($load['routes']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=yellow;options=bold>Load</> Translations' => ! empty($load['translations']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=yellow;options=bold>Load</> Views' => ! empty($load['views']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',

            '<fg=yellow;options=bold>Middleware</> auth' => ! empty($middleware['auth']) ? sprintf('%s', json_encode($middleware['auth'])) : '',
            '<fg=yellow;options=bold>Middleware</> default' => ! empty($middleware['default']) ? sprintf('%s', json_encode($middleware['default'])) : '',
            '<fg=yellow;options=bold>Middleware</> guest' => ! empty($middleware['guest']) ? sprintf('%s', json_encode($middleware['guest'])) : '',

            '<fg=blue;options=bold>View</> [Blade]' => ! empty($config['blade']) && is_string($config['blade']) ? sprintf('[%s]', $config['blade']) : '',

            '<fg=magenta;options=bold>Sitemap</> Views' => ! empty($sitemap['enable']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> Guest' => ! empty($sitemap['guest']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> User' => ! empty($sitemap['user']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',
            '<fg=magenta;options=bold>Sitemap</> [view]' => ! empty($sitemap['view']) && is_string($sitemap['view']) ? sprintf('[%s]', $sitemap['view']) : '',

            '<fg=red;options=bold>Route</> crm' => ! empty($routes['crm']) ? '<fg=green;options=bold>ENABLED</>' : '<fg=yellow;options=bold>DISABLED</>',

            'Package' => $this->package,
            'Version' => ServiceProvider::VERSION,
        ]);
    }
}
