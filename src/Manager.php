<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe;

use Illuminate\Redis\Connections\Connection;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Manager
 */
class Manager
{
    public const string KEY_RECIPE = 'make:recipe';

    public const string KEY_RECIPES = 'make:recipe:*';

    public const string PATH_CONF = 'resources/configurations';

    public const string PATH_RECIPES = 'resources/recipes';

    protected ?Connection $connection = null;

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    protected ?string $slug = null;

    public function slug(): ?string
    {
        return $this->slug;
    }

    public function redis(): Connection
    {
        if (empty($this->connection)) {
            $connection = config('playground.recipe.redis.connection');
            $this->connection = Redis::connection(
                ! empty($connection) && is_string($connection) ? $connection : null
            );
        }

        return $this->connection;
    }

    public function delete(string $slug): Manager
    {
        $this->redis()->del(sprintf('%1$s:%2$s', self::KEY_RECIPE, $slug));

        return $this;
    }

    public function get(string $slug): ?Recipe
    {
        $data = $this->redis()->get(sprintf('%1$s:%2$s', self::KEY_RECIPE, $slug));
        $data = is_string($data) ? json_decode($data, true) : null;

        if (empty($data) || ! is_array($data)) {
            return null;
        }

        $recipe = new Recipe($data);
        $recipe->apply();

        return $recipe;
    }

    /**
     * @return array<string, string>
     */
    public function index(): array
    {
        $recipes = [];

        foreach ($this->redis()->keys(self::KEY_RECIPES) as $key) {
            $recipes[$key] = Str::of($key)->after(self::KEY_RECIPE.':')->toString();
        }

        return $recipes;
    }

    /**
     * Load existing recipe files into the manager.
     *
     * @return string[]
     */
    public function load(string $recipe_slug = ''): array
    {
        $level = 'success';
        $with = '';

        $pathToConfigurations = $this->pathToConfigurations();
        $configurations = scandir($pathToConfigurations);
        $recipes = [];
        $files = [];
        if (is_array($configurations)) {
            foreach ($configurations as $filename) {
                if (preg_match('/^([a-z-_]+)\.json/', $filename, $matches)) {
                    $files[$matches[1]] = $pathToConfigurations.DIRECTORY_SEPARATOR.$matches[1].'.json';
                }
            }
        }

        foreach ($files as $recipe_slug => $path) {
            $payload = json_decode(file_get_contents($path) ?: '', true);
            if (! empty($with)) {
                $with .= '<br>';
            }
            if (is_array($payload) && ! empty($payload)) {
                $recipes[$recipe_slug] = new Recipe($payload);
                $recipes[$recipe_slug]->apply();
                $this->save($recipes[$recipe_slug]);
                $with .= sprintf(
                    'Loaded recipe configuration for %1$s at %2$s',
                    $recipe_slug,
                    $path,
                );
            } else {
                $level = 'warning';
                $with .= sprintf(
                    'Unable to load recipe configuration for %1$s at %2$s',
                    $recipe_slug,
                    $path,
                );
            }
        }

        return [$level, $with];
    }

    /**
     * @param  array<string, mixed>  $attributes
     */
    public function addModel(array $attributes): Manager
    {
        dump([
            '__METHOD__' => __METHOD__,
            '$attributes' => $attributes,
        ]);

        return $this;
    }

    public function save(Recipe $recipe): Manager
    {
        throw_if(empty($recipe->slug()), 'UnexpectedValueException', 'The recipe cannot be empty.');

        $this->redis()->set(
            sprintf('%1$s:%2$s', self::KEY_RECIPE, $recipe->slug()),
            json_encode($recipe->toArray(), JSON_PRETTY_PRINT),
        );

        return $this;
    }

    protected string $directory;

    protected string $pathToConfigurations;

    public function directory(): string
    {
        if (empty($this->directory)) {
            $this->directory = dirname(__DIR__);
        }

        return $this->directory;
    }

    public function pathToConfigurations(): string
    {
        if (empty($this->pathToConfigurations)) {
            $directory = $this->directory();
            $this->pathToConfigurations = $directory.DIRECTORY_SEPARATOR.self::PATH_CONF;
        }

        return $this->pathToConfigurations;
    }

    public function getConfigurationPath(string $recipe_slug): string
    {
        return sprintf(
            '%1$s/%2$s.json',
            $this->pathToConfigurations(),
            $recipe_slug
        );
    }

    /**
     * Save a recipe configuration to this package.
     *
     * @return string[] Returns a message that should be sent to the client.
     */
    public function saveConfiguration(Recipe $recipe): array
    {
        $path = $this->getConfigurationPath($recipe->slug());

        throw_if(
            ! is_dir($this->directory) || ! is_writable($this->directory),
            'RuntimeException',
            'Expecting the recipe configuration directory to exist and be writable: '.$this->directory
        );

        $bytes = file_put_contents($path, json_encode($recipe->toArray(), JSON_PRETTY_PRINT));
        if ($bytes === false) {
            $level = 'error';
            $with = sprintf(
                'Unable to find recipe configuration for %1$s',
                $recipe->slug(),
            );

        } else {
            $level = 'success';
            $with = sprintf(
                'Saved recipe configuration for %1$s [%3$s bytes] at %2$s',
                $recipe->slug(),
                $path,
                number_format($bytes, 0),
            );
        }

        return [$level, $with];
    }

    /**
     * Write a recipe source code file
     */
    public function saveSource(Recipe $recipe, bool $asPhp = false): string
    {
        $extension = $asPhp ? 'php' : 'phps';
        $path = sprintf('%1$s/%2$s.%3$s', self::PATH_RECIPES, $recipe->slug(), $extension);

        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$recipe' => $recipe,
        //            '$asPhp' => $asPhp,
        //            '$extension' => $extension,
        //            '$path' => $path,
        //        ]);
        return $path;
    }
}
