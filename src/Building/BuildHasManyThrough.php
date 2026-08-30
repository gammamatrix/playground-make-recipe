<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Building\BuildHasManyThrough
 */
trait BuildHasManyThrough
{
    protected function buildClass_hasManyThroughs(Recipe $recipe): void
    {
        $this->searches['HasManyThrough'] = '';

        if (empty($recipe->packageModels())) {
            return;
        }

        $code = PHP_EOL;

        if (in_array('revision', $recipe->flavors(), true)) {
            $code .= $this->buildClass_hasManyThrough(
                'revisions',
                'The revisions of the model.'
            );
        } else {
            return;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['HasManyThrough'] .= PHP_EOL;

        $this->searches['HasManyThrough'] .= sprintf('    protected array $hasManyThrough = [%1$s];',
            $code
        );

        $this->searches['HasManyThrough'] .= PHP_EOL;
    }

    protected function buildClass_hasManyThrough(
        string $accessor = '',
        string $comment = '',
        string $related = '',
        string $firstKey = '',
        string $secondKey = '',
        string $localKey = '',
        string $secondLocalKey = '',
        string $through = '',
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
        $code .= sprintf('\'firstKey\' => \'%1$s\',', $firstKey);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'secondKey\' => \'%1$s\',', $secondKey);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'localKey\' => \'%1$s\',', $localKey);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'secondLocalKey\' => \'%1$s\',', $secondLocalKey);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'through\' => \'%1$s\',', $through);

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '],';

        $code .= PHP_EOL;

        return $code;
    }
}
