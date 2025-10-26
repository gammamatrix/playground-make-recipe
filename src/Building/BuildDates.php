<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\Date;

/**
 * \Playground\Make\Recipe\Building\BuildDates
 */
trait BuildDates
{
    /**
     * @param  array<string, Date>  $dates
     */
    protected function buildClass_dates(array $dates): void
    {
        if (! $dates) {
            return;
        }

        $code = PHP_EOL;

        $this->searches['dates'] .= PHP_EOL;

        foreach ($dates as $column => $date) {
            dump([
                '__METHOD__' => __METHOD__,
                '$column' => $column,
                '$date' => $date,
            ]);
            $code .= str_repeat(' ', 8);
            $code .= sprintf('\'%1$s\' => [', $column);

            if ($date->description()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'description\' => \'%1$s\',', $date->description());
            }

            if ($date->label()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'label\' => \'%1$s\',', $date->label());
            }

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'nullable\' => %1$s,', $date->nullable() ? 'true' : 'false');

            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'index\' => %1$s,', $date->index() ? 'true' : 'false');

            if ($date->readOnly()) {
                $code .= PHP_EOL.str_repeat(' ', 12);
                $code .= sprintf('\'readOnly\' => %1$s,', 'true');
            }

            $code .= PHP_EOL.str_repeat(' ', 8);
            $code .= '],';

            $code .= PHP_EOL;
        }

        $code .= str_repeat(' ', 4);

        $this->searches['dates'] .= sprintf('    protected $dates = [%1$s];',
            $code
        );

        $this->searches['dates'] .= PHP_EOL;
    }
}
