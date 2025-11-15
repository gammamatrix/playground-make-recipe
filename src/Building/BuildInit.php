<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

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

        $flags = $this->buildClass_init_addFlags($recipe);

        if (! empty($flags)) {
            $this->searches['init'] .= $this->buildClass_addFlags_method($flags);
            $code .= str_repeat(' ', 8);
            $code .= '$this->addFlags();';
        }

        if (empty($flags)) {
            return;
        }

        $this->searches['init'] .= PHP_EOL;

        $this->searches['init'] .= $this->buildClass_init_method($code);
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

    protected function buildClass_addFlags_method(string $code): string
    {
        return <<<PHP_CODE

    public function addFlags(): void
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
