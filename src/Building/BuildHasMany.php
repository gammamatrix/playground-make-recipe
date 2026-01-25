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
