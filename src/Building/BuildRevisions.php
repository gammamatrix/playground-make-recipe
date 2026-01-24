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
 * \Playground\Make\Recipe\Building\BuildDates
 */
trait BuildRevisions
{
    protected function buildClass_revisions(Recipe $recipe): void
    {
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$recipe' => $recipe,
        //        ]);
        if (! in_array('revision', $recipe->flavors())) {
            return;
        }

        $models = [];
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$recipe' => $recipe,
        // ]);
        foreach ($recipe->packageModels() as $name => $model) {
            if (in_array('revision', $model->flavors())) {
                $models[$name] = $model;
            }
        }

        $this->searches['withRevisions'] .= PHP_EOL;

        $this->searches['withRevisions'] .= $this->buildClass_withRevisions_method($models);
    }

    /**
     * @param  array<string, PackageModel>  $models
     */
    protected function buildClass_withRevisions_method(array $models): string
    {
        $codeForModel = '';
        $codeNoHasManyRevisions = '';
        foreach ($models as $model => $packageModel) {
            if (is_string($model) && ! empty($model)) {
                $codeNoHasManyRevisions .= sprintf(
                    '%1$s\'%2$s\',%3$s',
                    str_repeat(' ', 12),
                    $model,
                    PHP_EOL
                );

                $codeForModel .= $this->buildClass_withRevisions_method_model($model);
            }
        }

        $codeNoHasManyRevisions = rtrim($codeNoHasManyRevisions, PHP_EOL);
        $codeForModel = rtrim($codeForModel, PHP_EOL);

        return <<<PHP_CODE

    public function withRevisions(): void
    {
        \$this->status['revision'] = [
            'type' => 'bigInteger',
            'default' => false,
            'unsigned' => true,
            'readOnly' => true,
            'icon' => '',
        ];

        if (! in_array(\$this->name(), [
$codeNoHasManyRevisions
        ])) {
            unset(\$this->hasMany['revisions']);
        }
$codeForModel
    }
PHP_CODE;
    }

    protected function buildClass_withRevisions_method_model(string $model): string
    {
        $snake = Str::of($model)->snake()->toString();
        $label = Str::of($snake)->replace('_', ' ')->toString();

        return <<<PHP_CODE

        if (in_array(\$this->name(), [
            '$model',
        ])) {
            \$this->hasMany['revisions']['comment'] = 'The revisions of the $label.';
            \$this->hasMany['revisions']['related'] = '{$model}Revision';
            \$this->hasMany['revisions']['foreignKey'] = '{$snake}_id';
        }

        if (! in_array(\$this->name(), [
            '{$model}Revision',
        ])) {
            unset(\$this->ids['{$snake}_id']);
            unset(\$this->hasOne['$snake']);
        }

PHP_CODE;
    }
}
