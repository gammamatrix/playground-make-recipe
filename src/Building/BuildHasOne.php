<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\PackageModel;
use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Building\BuildHasOne
 */
trait BuildHasOne
{
    protected function buildClass_circletHasOnes(Recipe $recipe): void
    {
        $this->searches['circletIds'] = '';

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
                $code .= $this->buildClass_hasOne(
                    $packageModel,
                    sprintf('The %1$s of the %%1$s.', $packageModel->word())
                );
            }
        }

        if ($code === '') {
            return;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['circletIds'] .= PHP_EOL.'    /**';
        $this->searches['circletIds'] .= PHP_EOL.'     * @var array<string, array<string, mixed>>';
        $this->searches['circletIds'] .= PHP_EOL.'     */';
        $this->searches['circletIds'] .= PHP_EOL;

        $this->searches['circletIds'] .= sprintf('    protected array $circletHasOne = [%1$s%2$s];',
            PHP_EOL,
            $code
        );

        $this->searches['circletIds'] .= PHP_EOL;
    }

    protected function buildClass_hasOnes(Recipe $recipe): void
    {
        $this->searches['HasOne'] = '';

        if (empty($recipe->packageModels())) {
            return;
        }

        $code = '';

        foreach ($recipe->packageModels() as $model => $packageModel) {
            // Do not add revision models
            if ($packageModel->revision()) {
                continue;
            }
            if (in_array('revision', $packageModel->flavors(), true)) {
                // dd($packageModel);
                $code .= $this->buildClass_hasOne(
                    $packageModel,
                    sprintf('The %1$s of the revision.', $packageModel->word())
                );
            }
        }

        if ($code === '') {
            return;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['HasOne'] .= PHP_EOL;

        $this->searches['HasOne'] .= sprintf('    protected array $hasOne = [%1$s%2$s];',
            PHP_EOL,
            $code
        );

        $this->searches['HasOne'] .= PHP_EOL;
    }

    protected function buildClass_hasOne(
        PackageModel $packageModel,
        string $comment = ''
    ): string {
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$packageModel' => $packageModel,
        // ]);

        $code = str_repeat(' ', 8);
        $code .= sprintf('\'%1$s\' => [', $packageModel->snake());

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'comment\' => \'%1$s\',', $comment);

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'accessor\' => \'%1$s\',', $packageModel->camel());

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'related\' => \'%1$s\',', $packageModel->model());

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'foreignKey\' => \'%1$s\',', 'id');

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'localKey\' => \'%1$s_id\',', $packageModel->snake());

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '],';

        $code .= PHP_EOL;

        return $code;
    }
}
