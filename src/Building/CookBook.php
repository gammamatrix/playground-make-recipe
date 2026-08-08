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
    use BuildFactoryStates;
    use BuildHasMany;
    use BuildHasOne;
    use BuildIds;
    use BuildInit;
    use BuildJsonColumns;
    use BuildRevisions;
    use BuildRouting;

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
        'circletIds' => '',
        'factoryStates' => '',
        'json' => '',
        'flags' => '',
        'init' => '',
        'withRevisions' => '',
        'withRouting' => '',
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

    public function defaults(Recipe $recipe): void
    {
        /**
         * @var array<string, string> $defaults
         */
        $defaults = config('playground-make-recipe.defaults');

        if (! empty($defaults['organization']) && is_string($defaults['organization'])) {
            $this->searches['organization'] = $defaults['organization'];
        }
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
        $this->defaults($recipe);

        // Disabled - adds TODO add flavor for dates?
        // $this->buildClass_dates($recipe->dates());
        $this->buildClass_factoryStates($recipe->factoryStates());
        // $this->buildClass_jsonColumns($recipe->json());
        $this->buildClass_ids($recipe);

        $this->buildClass_revisions($recipe);

        $this->buildClass_circletHasOnes($recipe);
        $this->buildClass_hasOnes($recipe);
        $this->buildClass_hasManies($recipe);

        $this->buildClass_routing($recipe);

        $this->buildClass_init($recipe);

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
