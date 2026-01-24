<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Building;

use Playground\Make\Recipe\Configuration\PackageModel;
use Playground\Make\Recipe\Configuration\Recipe;

/**
 * \Playground\Make\Recipe\Building\BuildDates
 */
trait BuildRouting
{
    protected function buildClass_routing(Recipe $recipe): void
    {
        if (! in_array('routing', $recipe->flavors())) {
            return;
        }

        $models = [];

        foreach ($recipe->packageModels() as $name => $model) {
            if (in_array('routing', $model->flavors())) {
                $models[$name] = $model;
            }
        }

        $this->searches['withRouting'] .= PHP_EOL;

        $this->searches['withRouting'] .= $this->buildClass_withRouting_method($models);
    }

    /**
     * @param  array<string, PackageModel>  $models
     */
    protected function buildClass_withRouting_method(array $models): string
    {
        $code = '';
        foreach ($models as $model => $packageModel) {
            if (is_string($model) && ! empty($model)) {
                $code .= sprintf(
                    '%1$s\'%2$s\',%3$s',
                    str_repeat(' ', 12),
                    $model,
                    PHP_EOL
                );
                if (in_array('revision', $packageModel->flavors())) {
                    $code .= sprintf(
                        '%1$s\'%2$sRevision\',%3$s',
                        str_repeat(' ', 12),
                        $model,
                        PHP_EOL
                    );
                }
            }
        }

        $code = rtrim($code, PHP_EOL);

        return <<<PHP_CODE

    public function withRouting(): void
    {
        if (in_array(\$this->name(), [
$code
        ])) {
            \$this->flags['is_external'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-close',
            ];
            \$this->flags['is_redirect'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-close',
            ];
            \$this->flags['sitemap'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-sitemap text-success',
            ];
            /**
             * Routing
             *
             * redirect_delay   in seconds
             * status_code      200 - 500
             * route            home, playground.cms.api.pages.create, ...
             * params
             */
            \$this->status['redirect_delay'] = [
                'type' => 'integer',
                'default' => false,
                'unsigned' => true,
                'icon' => '',
            ];
            \$this->status['status_code'] = [
                'type' => 'integer',
                'default' => false,
                'unsigned' => true,
                'icon' => '',
            ];
            \$this->status['route'] = [
                'type' => 'string',
                'nullable' => true,
                'size' => 255,
                'icon' => '',
            ];
            \$this->json['params'] = [
                'default' => '{}',
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }
    }
PHP_CODE;
    }
}
