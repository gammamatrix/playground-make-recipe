<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Building\BuildHasMany
 */
trait BuildHasMany
{
    protected function buildClass_circletHasManies(Recipe $recipe): void
    {
        $this->searches['circletHasMany'] = '';

        if (! in_array('circlet', $recipe->flavors(), true) || empty($recipe->packageModels())) {
            return;
        }

        $code = '';

        foreach ($recipe->packageModels() as $model => $packageModel) {
            // Do not add revision models
            if ($packageModel->revision()) {
                continue;
            }
            if (in_array('circlet', $packageModel->flavors(), true)) {
                // dd($packageModel);
                $code .= $this->buildClass_hasMany(
                    accessor: $packageModel->camels(),
                    comment: sprintf('The %1$s of the %%1$s.', $packageModel->words()),
                    related: $packageModel->model(),
                );
            }
        }

        if ($code === '') {
            return;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['circletHasMany'] .= PHP_EOL.'    /**';
        $this->searches['circletHasMany'] .= PHP_EOL.'     * @var array<string, array<string, mixed>>';
        $this->searches['circletHasMany'] .= PHP_EOL.'     */';
        $this->searches['circletHasMany'] .= PHP_EOL;

        $this->searches['circletHasMany'] .= sprintf('    protected array $circletHasMany = [%1$s%2$s];',
            PHP_EOL,
            $code
        );

        $this->searches['circletHasMany'] .= PHP_EOL;
    }

    protected function buildClass_hasManies(Recipe $recipe): void
    {
        $this->searches['HasMany'] = '';

        if (empty($recipe->packageModels())) {
            return;
        }

        $code = PHP_EOL;

        if (in_array('revision', $recipe->flavors(), true)) {
            $code .= $this->buildClass_hasMany(
                'revisions',
                'The revisions of the model.'
            );
        } else {
            return;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['HasMany'] .= PHP_EOL;

        $this->searches['HasMany'] .= sprintf('    protected array $hasMany = [%1$s];',
            $code
        );

        $this->searches['HasMany'] .= PHP_EOL;
    }

    protected function buildClass_hasMany(
        string $accessor = '',
        string $comment = '',
        string $related = '',
        string $foreignKey = '',
        string $localKey = 'id',
    ): string {

        $code = str_repeat(' ', 8);
        $code .= sprintf('\'%1$s\' => [', $accessor);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'comment\' => \'%1$s\',', $comment);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'accessor\' => \'%1$s\',', $accessor);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'related\' => \'%1$s\',', $related);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'foreignKey\' => \'%1$s\',', $foreignKey);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'localKey\' => \'%1$s\',', $localKey);

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '],';

        $code .= PHP_EOL;

        return $code;
    }
}
