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
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$recipe' => $recipe,
        //        ]);
        throw_if(empty($recipe->slug()), 'UnexpectedValueException', 'The recipe cannot be empty.');

        $this->redis()->set(
            sprintf('%1$s:%2$s', self::KEY_RECIPE, $recipe->slug()),
            json_encode($recipe->toArray(), JSON_PRETTY_PRINT),
        );

        return $this;
    }
}
