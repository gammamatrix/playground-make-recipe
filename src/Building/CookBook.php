<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Illuminate\Support\Facades\Log;
use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Building\CookBook
 */
class CookBook
{
    use BuildDates;
    use BuildJsonColumns;

    /**
     * @var array<string, string>
     */
    protected array $searches = [
        'class' => '',
        'namespace' => 'Playground\\',
        'extends' => 'Model',
        'implements' => '',
        'organization' => '',
        'use' => '',
        'use_class' => '',
        'docblock' => '',
        'HasMany' => '',
        'HasOne' => '',
        'dates' => '',
        'ids' => '',
        'factoryStates' => '',
        'json' => '',
        'flags' => '',
        'init' => '',
    ];

    protected function getStub(): string
    {
        $stub = sprintf('%1$s/resources/stubs/recipes/playground.stub', dirname(__DIR__, 2));

        return $stub;
    }

    protected function replace(string $destination): void
    {
        $stub = file_get_contents($this->getStub());
        if ($stub) {
            $this->search_and_replace($stub);
            if (file_put_contents($destination, $stub)) {
                Log::debug('Recipe saved', [
                    '$destination' => $destination,
                ]);
            }
        }
    }

    protected function search_and_replace(string &$stub): self
    {
        foreach ($this->searches as $search => $value) {
            $stub = str_replace([
                sprintf('{{%1$s}}', $search),
                sprintf('{{ %1$s }}', $search),
            ], $value, $stub);
        }

        return $this;
    }

    public function mix(Recipe $recipe): void
    {
        if ($recipe->class()) {
            $this->searches['class'] = $recipe->class();
        }

        if ($recipe->extends()) {
            $this->searches['extends'] = $recipe->extends();
        }
    }

    public function bake(Recipe $recipe, string $path): void
    {
        $this->buildClass_dates($recipe->dates());
        $this->buildClass_jsonColumns($recipe->json());

        $destination = sprintf('%1$s/%2$s', dirname(__DIR__, 2), $path);

        $this->mix($recipe);

        $this->replace($destination);
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$recipe' => $recipe,
        //            '$path' => $path,
        //            '$destination' => $destination,
        //            '$this->searches' => $this->searches,
        //            '$this->getStub()' => $this->getStub(),
        //        ]);
    }
}
