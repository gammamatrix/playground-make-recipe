<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Playground\Make\Model\Recipe\Playground;
use Playground\Make\Recipe\Configuration\Column;
use Playground\Make\Recipe\Configuration\Date;
use Playground\Make\Recipe\Configuration\Flag;
use Playground\Make\Recipe\Configuration\Json;
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

        if (in_array('tags', $recipe->flavors())) {
            $code .= $this->buildClass_init_tagged($recipe);
            $code .= $this->buildClass_init_tag($recipe);
        }

        $unsetIds = $this->buildClass_init_unsetIds($recipe);

        if (! empty($unsetIds)) {
            $this->searches['init'] .= $this->buildClass_unsetIds_method($unsetIds);
            $code .= str_repeat(' ', 8);
            $code .= '$this->unsetIds();'.PHP_EOL;
        }

        $columns = $this->buildClass_init_addColumns($recipe);

        if (! empty($columns)) {
            $this->searches['init'] .= $this->buildClass_addColumns_method($columns);
            $code .= str_repeat(' ', 8);
            $code .= '$this->addColumns();'.PHP_EOL;
        }

        $dates = $this->buildClass_init_addDates($recipe);

        if (! empty($dates)) {
            $this->searches['init'] .= $this->buildClass_addDates_method($dates);
            $code .= str_repeat(' ', 8);
            $code .= '$this->addDates();'.PHP_EOL;
        }

        $flags = $this->buildClass_init_addFlags($recipe);

        if (! empty($flags)) {
            $this->searches['init'] .= $this->buildClass_addFlags_method($flags);
            $code .= str_repeat(' ', 8);
            $code .= '$this->addFlags();'.PHP_EOL;
        }

        $json = $this->buildClass_init_addJsons($recipe);

        if (! empty($json)) {
            $this->searches['init'] .= $this->buildClass_addJson_method($json);
            $code .= str_repeat(' ', 8);
            $code .= '$this->addJson();'.PHP_EOL;
        }

        if (in_array('circlet', $recipe->flavors())) {
            $code .= str_repeat(' ', 8);
            $code .= '$this->handleCircletHasOne();'.PHP_EOL;
            $code .= str_repeat(' ', 8);
            $code .= '$this->handleCircletHasMany();'.PHP_EOL;
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

    protected function buildClass_unsetIds_method(string $code): string
    {
        return <<<PHP_CODE

    public function unsetIds(): void
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
            if (! empty($column->only())) {
                $code .= str_repeat(' ', 8).'if (in_array($this->name, [';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $column->only()));
                $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                $code .= $this->buildClass_init_addColumn($column, 12);
                $code .= PHP_EOL.str_repeat(' ', 8).'}';
            } elseif (! empty($column->exclude())) {
                $code .= str_repeat(' ', 8).'if (! in_array($this->name, [';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $column->exclude()));
                $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                $code .= $this->buildClass_init_addColumn($column, 12);
                $code .= PHP_EOL.str_repeat(' ', 8).'}';
            } else {
                $code .= $this->buildClass_init_addColumn($column);
            }

            $i++;
            if ($i < $total) {
                $code .= PHP_EOL.PHP_EOL;
            }
        }

        return $code;
    }

    protected function buildClass_init_addColumn(
        Column $column,
        int $indent = 8,
    ): string {
        $code = str_repeat(' ', $indent);
        $code .= sprintf('$this->columns[\'%1$s\'] = [', $column->column());

        if ($column->comment()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'comment\' => \'%1$s\',', $column->comment());
        }

        if ($column->description()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            if (str_contains($column->description(), '%1$s')) {
                $code .= '\'description\' => sprintf('.PHP_EOL;
                $code .= sprintf('%1$s\'%2$s\',', str_repeat(' ', 16), $column->description()).PHP_EOL;
                $code .= str_repeat(' ', $indent + 8).'$this->name_lower'.PHP_EOL;
                $code .= str_repeat(' ', $indent + 4).'),';
            } else {
                $code .= sprintf('\'description\' => \'%1$s\',', $column->description());
            }
        }

        if ($column->icon()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'icon\' => \'%1$s\',', $column->icon());
        }

        if ($column->hasDefault()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
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

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'label\' => \'%1$s\',', $column->label() ?: Str::of($column->column())->headline()->lower()->ucfirst()->toString());

        if (is_int($column->precision())) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'precision\' => %1$d,', $column->precision());
        }

        if (is_int($column->scale())) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'scale\' => %1$d,', $column->scale());
        }

        if ($column->html()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'html\' => %1$s,', 'true');
        }

        if ($column->index()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'index\' => %1$s,', 'true');
        }

        if ($column->nullable()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');
        }

        if ($column->readOnly()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'readOnly\' => %1$s,', 'true');
        }

        if ($column->size()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'size\' => %1$s,', is_numeric($column->size()) ? $column->size() : 'null');
        }

        if (in_array($column->type(), [
            'integer',
            'bigInteger',
            'mediumInteger',
            'smallInteger',
            'tinyInteger',
        ])) {
            if ($column->unsigned()) {
                $code .= PHP_EOL.str_repeat(' ', $indent + 4);
                $code .= sprintf('\'unsigned\' => %1$s,', 'true');
            }
        }

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'type\' => \'%1$s\',', $column->type());

        $code .= PHP_EOL.str_repeat(' ', $indent);
        $code .= '];';

        return $code;
    }

    protected function buildClass_init_addDates(Recipe $recipe): string
    {
        $code = '';

        $ignore = array_keys((new Playground('model', 'playground'))->dates());

        /**
         * @var array<string, Date> $dates
         */
        $dates = Arr::except($recipe->dates(), $ignore);
        $total = count($dates);
        $i = 0;
        foreach ($recipe->dates() as $column => $date) {
            if (! empty($date->only())) {
                $code .= str_repeat(' ', 8).'if (in_array($this->name, [';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $date->only()));
                $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                $code .= $this->buildClass_init_addDate($date, 12);
                $code .= PHP_EOL.str_repeat(' ', 8).'}'.PHP_EOL.PHP_EOL;
            } elseif (! empty($date->exclude())) {

                if (in_array($column, $ignore)) {
                    $code .= str_repeat(' ', 8).'if (in_array($this->name, [';
                    $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $date->exclude()));
                    $code .= PHP_EOL.str_repeat(' ', 8).'])) {';
                    $code .= PHP_EOL.str_repeat(' ', 12).sprintf('unset($this->dates[\'%1$s\']);', $column);
                    $code .= PHP_EOL.str_repeat(' ', 8).'}'.PHP_EOL.PHP_EOL;
                } else {
                    $code .= str_repeat(' ', 8).'if (! in_array($this->name, [';
                    $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $date->exclude()));
                    $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                    $code .= $this->buildClass_init_addDate($date, 12);
                    $code .= PHP_EOL.str_repeat(' ', 8).'}'.PHP_EOL.PHP_EOL;
                }

            } else {
                if (! in_array($column, $ignore)) {
                    $code .= $this->buildClass_init_addDate($date);
                }
            }

            //            $i++;
            //            if ($i < $total) {
            //                $code .= PHP_EOL.PHP_EOL;
            //            }
        }

        //         dd([
        //            '__METHOD__' => __METHOD__,
        //            '$code' => $code,
        //            '$total' => $total,
        //            '$ignore' => $ignore,
        //            'Arr::except($recipe->dates(), $ignore)' => Arr::except($recipe->dates(), $ignore),
        //         ]);
        return rtrim($code, PHP_EOL);
    }

    protected function buildClass_init_addDate(
        Date $date,
        int $indent = 8
    ): string {
        $code = str_repeat(' ', $indent);
        $code .= sprintf('$this->dates[\'%1$s\'] = [', $date->column());

        if ($date->description()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'description\' => \'%1$s\',', $date->description());
        }

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'label\' => \'%1$s\',', $date->label() ?: Str::of($date->column())->headline()->lower()->ucfirst()->toString());

        if ($date->index()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'index\' => %1$s,', 'true');
        }

        if ($date->nullable()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');
        }

        if ($date->readOnly()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'readOnly\' => %1$s,', 'true');
        }

        $code .= PHP_EOL.str_repeat(' ', $indent);
        $code .= '];';

        return $code;
    }

    protected function buildClass_init_addFlags(Recipe $recipe): string
    {
        $code = '';

        $ignore = array_keys((new Playground('model', 'playground'))->flags());

        $i = 0;
        $total = count($recipe->flags());
        foreach ($recipe->flags() as $column => $flag) {
            //            dump([
            //                '__METHOD__' => __METHOD__,
            //                '$column' => $column,
            //                '$flag' => $flag,
            //            ]);
            if (! empty($flag->only())) {
                $code .= str_repeat(' ', 8).'if (in_array($this->name, [';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $flag->only()));
                $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                $code .= $this->buildClass_init_addFlag($flag, 12);
                $code .= PHP_EOL.str_repeat(' ', 8).'}';
            } elseif (! empty($flag->exclude())) {

                if (in_array($column, $ignore)) {
                    $code .= str_repeat(' ', 8).'if (in_array($this->name, [';
                    $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $flag->exclude()));
                    $code .= PHP_EOL.str_repeat(' ', 8).'])) {';
                    $code .= PHP_EOL.str_repeat(' ', 12).sprintf('unset($this->flags[\'%1$s\']);', $column);
                    $code .= PHP_EOL.str_repeat(' ', 8).'}';
                } else {
                    $code .= str_repeat(' ', 8).'if (! in_array($this->name, [';
                    $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $flag->exclude()));
                    $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                    $code .= $this->buildClass_init_addFlag($flag, 12);
                    $code .= PHP_EOL.str_repeat(' ', 8).'}';
                }

            } else {
                $code .= $this->buildClass_init_addFlag($flag);
            }
            $i++;
            if ($i < $total) {
                $code .= PHP_EOL.PHP_EOL;
            }
        }

        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$code' => $code,
        // ]);
        return $code;
    }

    protected function buildClass_init_addFlag(
        Flag $flag,
        int $indent = 8
    ): string {
        $code = str_repeat(' ', $indent);
        $code .= sprintf('$this->flags[\'%1$s\'] = [', $flag->column());

        if ($flag->description()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'description\' => \'%1$s\',', $flag->description());
        }

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'icon\' => \'%1$s\',', $flag->icon());

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'default\' => %1$s,', $flag->default() ? 'true' : 'false');

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'label\' => \'%1$s\',', $flag->label() ?: Str::of($flag->column())->headline()->lower()->ucfirst()->toString());

        if ($flag->index()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'index\' => %1$s,', 'true');
        }

        if ($flag->nullable()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'nullable\' => %1$s,', 'true');
        }

        if ($flag->readOnly()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'readOnly\' => %1$s,', 'true');
        }

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'type\' => \'%1$s\',', 'boolean');

        $code .= PHP_EOL.str_repeat(' ', $indent);
        $code .= '];';

        return $code;
    }

    protected function buildClass_init_addJsons(Recipe $recipe): string
    {
        $code = '';

        $ignore = array_keys((new Playground('model', 'playground'))->json());

        /**
         * @var array<string, Json> $jsons
         */
        $jsons = Arr::except($recipe->json(), $ignore);
        $total = count($jsons);
        $i = 0;
        foreach ($jsons as $column => $json) {
            if (! empty($json->only())) {
                $code .= str_repeat(' ', 8).'if (in_array($this->name, [';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $json->only()));
                $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                $code .= $this->buildClass_init_addJson($json, 12);
                $code .= PHP_EOL.str_repeat(' ', 8).'}';
            } elseif (! empty($json->exclude())) {
                $code .= str_repeat(' ', 8).'if (! in_array($this->name, [';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $json->exclude()));
                $code .= PHP_EOL.str_repeat(' ', 8).'])) {'.PHP_EOL;
                $code .= $this->buildClass_init_addJson($json, 12);
                $code .= PHP_EOL.str_repeat(' ', 8).'}';
            } else {
                $code .= $this->buildClass_init_addJson($json);
            }
            $i++;
            if ($i < $total) {
                $code .= PHP_EOL.PHP_EOL;
            }
        }

        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$code' => $code,
        //    '$total' => $total,
        //    '$ignore' => $ignore,
        //    'Arr::except($recipe->json(), $ignore)' => Arr::except($recipe->json(), $ignore),
        // ]);
        return $code;
    }

    protected function buildClass_init_addJson(
        Json $json,
        int $indent = 8
    ): string {
        $code = str_repeat(' ', $indent);
        $code .= sprintf('$this->json[\'%1$s\'] = [', $json->column());

        if ($json->comment()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'comment\' => \'%1$s\',', $json->comment());
        }

        if ($json->description()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'description\' => \'%1$s\',', $json->description());
        }

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'label\' => \'%1$s\',', $json->label() ?: Str::of($json->column())->headline()->lower()->ucfirst()->toString());

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

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'default\' => %1$s,', $defaultString);

        $code .= PHP_EOL.str_repeat(' ', $indent + 4);
        $code .= sprintf('\'nullable\' => %1$s,', $json->nullable() ? 'true' : 'false');

        if ($json->readOnly()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'readOnly\' => %1$s,', 'true');
        }

        if ($json->type()) {
            $code .= PHP_EOL.str_repeat(' ', $indent + 4);
            $code .= sprintf('\'type\' => \'%1$s\',', $json->type());
        }

        $code .= PHP_EOL.str_repeat(' ', $indent);
        $code .= '];';

        return $code;
    }

    protected function buildClass_init_unsetIds(Recipe $recipe): string
    {
        $code = '';

        $i = 0;
        $total = count($recipe->packageModels());
        foreach ($recipe->packageModels() as $modelClassName => $model) {
            if (! empty($model->exclude())) {
                $code .= str_repeat(' ', 8).'if (in_array($this->name, [';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('\'%1$s\',', implode('\', \'', $model->exclude()));
                $code .= PHP_EOL.str_repeat(' ', 8).'])) {';
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('unset($this->allIds[\'%1$s_id\']);', $model->snake());
                $code .= PHP_EOL.str_repeat(' ', 12).sprintf('unset($this->circletHasOne[\'%1$s\']);', $model->snake());
                // TODO not sure about this one:
                // $code .= PHP_EOL.str_repeat(' ', 12).sprintf('unset($this->circletHasMany[\'%1$s\']);', $model->snakes());
                $code .= PHP_EOL.str_repeat(' ', 8).'}';
            }

            $i++;
            if ($i < $total) {
                $code .= PHP_EOL.PHP_EOL;
            }
        }

        return rtrim($code, PHP_EOL);
    }

    protected function buildClass_init_tag(Recipe $recipe): string
    {
        $unset = '';

        if (in_array('revision', $recipe->flavors(), true)) {
            $unset = PHP_EOL.str_repeat(' ', 12).'unset($this->hasMany[\'revisions\']);';
        }

        $onlyIds = [
            'parent_id',
            'matrix_id',
        ];

        $only = sprintf('\'%1$s\'', implode('\', \'', $onlyIds));

        return <<<PHP_CODE
        /**
         * @var array<string, array<string, mixed>> \$onlyIds
         */
        \$onlyIds = \Illuminate\Support\Arr::only(\$this->allIds, [$only]);

        if (\$this->name === 'Tag') {
            \$this->allIds = \$onlyIds;$unset
            \$this->circletHasOne = [];
            \$this->circletHasMany = [];
            \$this->hasManyThrough = [];
            \$this->handleCircletHasOne();

            return;
        }

        \$this->hasManyThrough['tags']['firstKey'] = \$this->table_id;
        \$this->hasManyThrough['tags']['comment'] = sprintf('The tags of the %1\$s.', \$this->name_lower());

        unset(\$this->allIds['tag_id']);
        unset(\$this->allIds['tagged_id']);
        unset(\$this->circletHasOne['tag']);
        unset(\$this->circletHasMany['tags']);


PHP_CODE;
    }

    protected function buildClass_init_tagged(Recipe $recipe): string
    {
        $unset = '';

        if (in_array('revision', $recipe->flavors(), true)) {
            $unset = PHP_EOL.str_repeat(' ', 12).'unset($this->hasMany[\'revisions\']);';
        }

        $exceptIds = [
            'parent_id',
            'matrix_id',
        ];

        $except = sprintf('\'%1$s\'', implode('\', \'', $exceptIds));

        $circletHasOneComments = '';
        foreach ($recipe->packageModels() as $model => $packageModel) {
            // Do not add revision models
            if ($packageModel->revision()) {
                continue;
            }
            if (in_array('circlet', $packageModel->flavors(), true)) {
                $circletHasOneComments .= PHP_EOL.str_repeat(' ', 12);
                $circletHasOneComments .= sprintf(
                    '$this->circletHasOne[\'%1$s\'][\'comment\'] = \'The tagged %2$s.\';',
                    $packageModel->model_variable() ?: Str::of($model)->camel()->toString(),
                    $packageModel->model_lower() ?: Str::of($model)->headline()->lower()->toString()
                );
            }
        }

        return <<<PHP_CODE
        /**
         * @var array<string, array<string, mixed>> \$allIds
         */
        \$allIds = \Illuminate\Support\Arr::except(\$this->allIds, [$except]);

        if (\$this->type === 'playground-model-tagged') { $circletHasOneComments
            \$this->allIds = \$allIds;$unset
            \$this->handleTagged();
            \$this->handleCircletHasOne();

            return;
        }


PHP_CODE;
    }
}
