<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Illuminate\Support\Str;
use Playground\Make\Recipe\Configuration\PackageModel;
use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Building\BuildIds
 */
trait BuildIds
{
    protected function buildClass_ids(Recipe $recipe): void
    {
        $this->searches['ids'] = '';

        $parent_id = $this->buildClass_parent_id($recipe);

        if (empty($parent_id) && empty($recipe->packageModels())) {
            return;
        }

        $code = PHP_EOL.$parent_id;

        foreach ($recipe->packageModels() as $basename => $packageModel) {
            if ($packageModel->revision()) {
                // Do not add revision models
                continue;
            }
            $code .= $this->buildClass_id($recipe, $packageModel);
        }

        $code .= str_repeat(' ', 4);

        $this->searches['ids'] .= PHP_EOL;

        $this->searches['ids'] .= sprintf('    protected array $ids = [%1$s];',
            $code
        );
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$this->searches' => $this->searches,
        //        ]);

        $this->searches['ids'] .= PHP_EOL;
    }

    protected function buildClass_id(Recipe $recipe, PackageModel $packageModel): string
    {
        $attribute = $packageModel->model_attribute();
        $snake = $attribute ?: Str::of($packageModel->model_singular())->snake()->toString();
        $snakes = Str::of($packageModel->model_plural())->snake()->toString();

        $code = str_repeat(' ', 8);
        $code .= sprintf('\'%1$s_id\' => [', $snake);

        if ($packageModel->playground()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'description\' => \'%1$s\',', $packageModel->description());

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= '\'foreign\' => [';

            $code .= PHP_EOL.str_repeat(' ', 16);
            $code .= sprintf('\'references\' => \'%1$s\',', 'id');

            $table = sprintf('%1$s_%2$s', $recipe->slug(), $snakes);

            $code .= PHP_EOL.str_repeat(' ', 16);
            $code .= sprintf('\'on\' => \'%1$s\',', $table);

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= '],';

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'index\' => %1$s,', 'true');

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'type\' => \'%1$s\',', 'uuid');
        }

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '],';

        $code .= PHP_EOL;
        //        dump([
        //            '__METHOD__' => __METHOD__,
        //            '$snake' => $snake,
        //            '$snakes' => $snakes,
        //            '$code' => $code,
        //        ]);

        return $code;
    }

    protected function buildClass_parent_id(Recipe $recipe): string
    {
        if (! in_array('parent', $recipe->flavors(), true)) {
            return '';
        }

        $code = str_repeat(' ', 8);
        $code .= sprintf('\'%1$s_id\' => [', 'parent');

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'description\' => \'%1$s\',', '');

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= '\'foreign\' => [';

        $code .= PHP_EOL.str_repeat(' ', 16);
        $code .= sprintf('\'references\' => \'%1$s\',', 'id');

        $code .= PHP_EOL.str_repeat(' ', 16);
        $code .= sprintf('\'on\' => %1$s,', 'null');

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= '],';

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'nullable\' => %1$s,', 'true');

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'index\' => %1$s,', 'true');

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'trait\' => \'%1$s\',', 'WithParent');

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'type\' => \'%1$s\',', 'uuid');

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '],';

        $code .= PHP_EOL;

        return $code;
    }
}
