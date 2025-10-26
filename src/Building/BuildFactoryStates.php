<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\FactoryState;

/**
 * \Playground\Make\Recipe\Building\BuildFactoryStates
 */
trait BuildFactoryStates
{
    /**
     * @param  array<string, FactoryState>  $factoryStates
     */
    protected function buildClass_factoryStates(array $factoryStates): void
    {
        if (! $factoryStates) {
            return;
        }

        $code = PHP_EOL;

        $this->searches['factoryStates'] .= PHP_EOL;

        foreach ($factoryStates as $state => $factoryState) {
            //            dump([
            //                '__METHOD__' => __METHOD__,
            //                '$column' => $column,
            //                '$factoryState' => $factoryState,
            //            ]);
            $code .= str_repeat(' ', 8);
            $code .= sprintf('\'%1$s\' => [', $state);

            if ($factoryState->description()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'description\' => \'%1$s\',', $factoryState->description());
            }

            if ($factoryState->type()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'type\' => \'%1$s\',', $factoryState->type());
            }

            $value = $factoryState->value();

            $valueString = 'null';

            switch (gettype($value)) {
                case 'boolean':
                    $valueString = $value ? 'true' : 'false';
                    break;
                case 'string':
                    $valueString = sprintf('\'%1$s\'', $value);
                    break;
                case 'integer':
                    break;
            }

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'value\' => %1$s,', $valueString);

            $code .= PHP_EOL.str_repeat(' ', 8);
            $code .= '],';

            $code .= PHP_EOL;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['factoryStates'] .= sprintf('    protected array $factoryState = [%1$s];',
            $code
        );

        $this->searches['factoryStates'] .= PHP_EOL;
    }
}
