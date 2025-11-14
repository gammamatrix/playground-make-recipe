<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\PackageModel;

/**
 * \Playground\Make\Recipe\Building\BuildIds
 */
trait BuildIds
{
    /**
     * @param  array<string, PackageModel>  $packageModels
     */
    protected function buildClass_ids(array $packageModels): void
    {
        if (! $packageModels) {
            return;
        }

        $code = PHP_EOL;

        $this->searches['ids'] .= PHP_EOL;

        foreach ($packageModels as $basename => $packageModel) {
            $code .= $this->buildClass_id($packageModel);
        }

        $code .= str_repeat(' ', 4);

        $this->searches['ids'] .= sprintf('    protected array $ids = [%1$s];',
            $code
        );

        $this->searches['ids'] .= PHP_EOL;
    }

    protected function buildClass_id(PackageModel $packageModel): string
    {
        $code = str_repeat(' ', 8);
        $code .= sprintf('\'%1$s_id\' => [', $packageModel->model_attribute());

        if ($packageModel->playground()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'description\' => \'%1$s\',', $packageModel->description());

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'type\' => \'%1$s\',', 'uuid');
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'index\' => %1$s,', 'true');
        }

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '],';

        $code .= PHP_EOL;

        return $code;
    }
}
