<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\Json;

/**
 * \Playground\Make\Recipe\Building\BuildJsonColumns
 */
trait BuildJsonColumns
{
    /**
     * @param  array<string, Json>  $jsonColumns
     */
    protected function buildClass_jsonColumns(array $jsonColumns): void
    {
        if (! $jsonColumns) {
            return;
        }

        $code = PHP_EOL;

        $this->searches['json'] .= PHP_EOL;

        foreach ($jsonColumns as $column => $json) {
            //            dump([
            //                '__METHOD__' => __METHOD__,
            //                '$column' => $column,
            //                '$json' => $json,
            //            ]);
            $code .= str_repeat(' ', 8);
            $code .= sprintf('\'%1$s\' => [', $column);

            if ($json->comment()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'comment\' => \'%1$s\',', $json->comment());
            }

            if ($json->description()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'description\' => \'%1$s\',', $json->description());
            }

            if ($json->label()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'label\' => \'%1$s\',', $json->label());
            }

            $default = $json->default();

            $defaultString = 'null';

            switch (gettype($default)) {
                case 'boolean':
                    $defaultString = $default ? 'true' : 'false';
                    break;
                case 'string':
                    $defaultString = sprintf('\'%1$s\'', $default);
                    break;
                case 'integer':
                    break;
            }

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'default\' => %1$s,', $defaultString);

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'nullable\' => %1$s,', $json->nullable() ? 'true' : 'false');

            if ($json->readOnly()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'readOnly\' => %1$s,', 'true');
            }

            if ($json->type()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'type\' => \'%1$s\',', $json->type());
            }

            $code .= PHP_EOL.str_repeat(' ', 8);
            $code .= '],';

            $code .= PHP_EOL;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['json'] .= sprintf('    protected array $json = [%1$s];',
            $code
        );

        $this->searches['json'] .= PHP_EOL;
    }
}
