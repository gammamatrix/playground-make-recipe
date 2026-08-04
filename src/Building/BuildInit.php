<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Illuminate\Support\Arr;
use Playground\Make\Recipe\Configuration\Column;
use Playground\Make\Recipe\Configuration\Date;
use Playground\Make\Recipe\Configuration\Flag;
use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Building\BuildInit
 */
trait BuildInit
{
    protected function buildClass_init(Recipe $recipe): void
    {
        $this->searches['init'] = '';

        $code = '';

        $columns = $this->buildClass_init_addColumns($recipe);

        if (! empty($columns)) {
            $this->searches['init'] .= $this->buildClass_addColumns_method($columns);
            $code .= str_repeat(' ', 8);
            $code .= '$this->addColumns();';
        }

        $dates = $this->buildClass_init_addDates($recipe);

        if (! empty($dates)) {
            $this->searches['init'] .= $this->buildClass_addDates_method($dates);
            if (! empty($code)) {
                $code .= PHP_EOL;
                $this->searches['init'] .= PHP_EOL;
            }
            $code .= str_repeat(' ', 8);
            $code .= '$this->addDates();'.PHP_EOL;
        }

        $flags = $this->buildClass_init_addFlags($recipe);

        if (! empty($flags)) {
            $this->searches['init'] .= $this->buildClass_addFlags_method($flags);
            if (! empty($code)) {
                $code .= PHP_EOL;
                $this->searches['init'] .= PHP_EOL;
            }
            $code .= str_repeat(' ', 8);
            $code .= '$this->addFlags();'.PHP_EOL;
        }

        if (! empty($this->searches['HasOne'])) {
            $code .= str_repeat(' ', 8);
            $code .= '$this->handleHasOne();'.PHP_EOL;
        }

        if (! empty($this->searches['withRevisions'])) {
            $code .= str_repeat(' ', 8);
            $code .= '$this->withRevisions();'.PHP_EOL;
        }

        if (! empty($this->searches['withRouting'])) {
            $code .= str_repeat(' ', 8);
            $code .= '$this->withRouting();'.PHP_EOL;
        }

        $this->searches['init'] .= $this->buildClass_init_method(rtrim($code, PHP_EOL));
    }

    protected function buildClass_init_method(string $code): string
    {
        return <<<PHP_CODE

    public function init(): void
    {
$code
    }
PHP_CODE;
    }

    protected function buildClass_addColumns_method(string $code): string
    {
        return <<<PHP_CODE

    public function addColumns(): void
    {
$code
    }

PHP_CODE;
    }

    protected function buildClass_addDates_method(string $code): string
    {
        return <<<PHP_CODE

    public function addDates(): void
    {
$code

        ksort(\$this->dates);
    }
PHP_CODE;
    }

    protected function buildClass_addFlags_method(string $code): string
    {
        return <<<PHP_CODE

    public function addFlags(): void
    {
$code

        ksort(\$this->flags);
    }
PHP_CODE;
    }

    protected function buildClass_addJson_method(string $code): string
    {
        return <<<PHP_CODE

    public function addJson(): void
    {
$code
    }
PHP_CODE;
    }

    protected function buildClass_init_addColumns(Recipe $recipe): string
    {
        $code = '';

        $i = 0;
        $total = count($recipe->columns());
        foreach ($recipe->columns() as $key => $column) {
            $code .= $this->buildClass_init_addColumn($column);
            $i++;
            if ($i < $total) {
                $code .= PHP_EOL.PHP_EOL;
            }
        }

        return $code;
    }

    protected function buildClass_init_addColumn(Column $column): string
    {
        $code = str_repeat(' ', 8);
        $code .= sprintf('$this->columns[\'%1$s\'] = [', $column->column());

        if ($column->comment()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'comment\' => \'%1$s\',', $column->comment());
        }

        if ($column->description()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'description\' => \'%1$s\',', $column->description());
        }

        if ($column->icon()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'icon\' => \'%1$s\',', $column->icon());
        }

        if ($column->hasDefault()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            if (is_bool($column->default())) {
                $code .= sprintf('\'default\' => %1$s,', $column->default() ? 'true' : 'false');
            } elseif (is_string($column->default())) {
                $code .= sprintf('\'default\' => \'%1$s\',', $column->default());
            } elseif (is_numeric($column->default())) {
                $code .= sprintf('\'default\' => %1$s,', $column->default());
            } else {
                // TODO there could be other value types here.
                $code .= sprintf('\'default\' => %1$s,', null);
            }
        }

        if ($column->label()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'label\' => \'%1$s\',', $column->label());
        }

        if (is_int($column->precision())) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'precision\' => %1$d,', $column->precision());
        }

        if ($column->html()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'html\' => %1$s,', 'true');
        }

        if ($column->index()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'index\' => %1$s,', 'true');
        }

        if ($column->nullable()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');
        }

        if ($column->readOnly()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'readOnly\' => %1$s,', 'true');
        }

        if (in_array($column->type(), [
            'integer',
            'bigInteger',
            'mediumInteger',
            'smallInteger',
            'tinyInteger',
        ])) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'unsigned\' => %1$s,', 'true');
        }

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'type\' => \'%1$s\',', $column->type());

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '];';

        return $code;
    }

    protected function buildClass_init_addDates(Recipe $recipe): string
    {
        $code = '';

        $ignore = array_keys((new \Playground\Make\Model\Recipe\Playground('model', 'playground'))->dates());

        $total = count(Arr::except($recipe->dates(), $ignore));
        $i = 0;
        foreach (Arr::except($recipe->dates(), $ignore) as $column => $date) {
            $code .= $this->buildClass_init_addDate($date);
            $i++;
            if ($i < $total) {
                $code .= PHP_EOL.PHP_EOL;
            }
        }

        //dd([
        //    '__METHOD__' => __METHOD__,
        //    '$code' => $code,
        //    '$total' => $total,
        //    '$ignore' => $ignore,
        //    'Arr::except($recipe->dates(), $ignore)' => Arr::except($recipe->dates(), $ignore),
        //]);
        return $code;
    }

    protected function buildClass_init_addDate(Date $date): string
    {
        $code = str_repeat(' ', 8);
        $code .= sprintf('$this->dates[\'%1$s\'] = [', $date->column());

        if ($date->description()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'description\' => \'%1$s\',', $date->description());
        }

        if ($date->label()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'label\' => \'%1$s\',', $date->label());
        }

        if ($date->index()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'index\' => %1$s,', 'true');
        }

        if ($date->nullable()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');
        }

        if ($date->readOnly()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'readOnly\' => %1$s,', 'true');
        }

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '];';

        return $code;
    }

    protected function buildClass_init_addFlags(Recipe $recipe): string
    {
        $code = '';

        $i = 0;
        $total = count($recipe->flags());
        foreach ($recipe->flags() as $column => $flag) {
            $code .= $this->buildClass_init_addFlag($flag);
            $i++;
            if ($i < $total) {
                $code .= PHP_EOL.PHP_EOL;
            }
        }

        return $code;
    }

    protected function buildClass_init_addFlag(Flag $flag): string
    {
        $code = str_repeat(' ', 8);
        $code .= sprintf('$this->flags[\'%1$s\'] = [', $flag->column());

        if ($flag->description()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'description\' => \'%1$s\',', $flag->description());
        }

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'icon\' => \'%1$s\',', $flag->icon());

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'default\' => %1$s,', $flag->default() ? 'true' : 'false');

        if ($flag->label()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'label\' => \'%1$s\',', $flag->label());
        }

        if ($flag->index()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'index\' => %1$s,', 'true');
        }

        if ($flag->nullable()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');
        }

        if ($flag->readOnly()) {
            $code .= PHP_EOL.str_repeat(' ', 12);
            $code .= sprintf('\'readOnly\' => %1$s,', 'true');
        }

        $code .= PHP_EOL.str_repeat(' ', 12);
        $code .= sprintf('\'type\' => \'%1$s\',', 'boolean');

        $code .= PHP_EOL.str_repeat(' ', 8);
        $code .= '];';

        return $code;
    }
}
