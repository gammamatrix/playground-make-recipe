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

    protected ?Connection $connection = null;

    public function redis(): Connection
    {
        if (empty($this->connection)) {
            $connection = config('playground.recipe.redis.connection');
            $this->connection = Redis::connection(
                !empty($connection) && is_string($connection) ? $connection : null
            );
        }

        return $this->connection;
    }

    public function get(string $slug): ?Recipe
    {
        $recipe = $this->redis()->get(sprintf('%1$s:%2$s', self::KEY_RECIPE, $slug));
        $recipe = is_string($recipe) ? json_decode($recipe, true) : null;

        if (empty($recipe) || ! is_array($recipe)) {
            return null;
        }

        return new Recipe($recipe);
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

    public function save(string $slug, Recipe $recipe): Manager
    {

        $this->redis()->set(
            sprintf('%1$s:%2$s', self::KEY_RECIPE, $slug),
            json_encode($recipe->toArray(), JSON_PRETTY_PRINT),
        );

        return $this;
    }
}
