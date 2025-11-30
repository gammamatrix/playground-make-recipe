<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\PackageModel;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Models
 */
trait PackageModels
{
    /**
     * @var array<string, PackageModel>
     */
    protected array $packageModels = [];

    public function addPackageModel(string $className, PackageModel $model): self
    {
        throw_if(empty($className), 'InvalidArgumentException', '$className is not allowed to be empty.');
        $this->packageModels[$className] = $model;
        $this->packageModels[$className]->apply();

        return $this;
    }

    public function removePackageModel(string $className): self
    {
        throw_if(empty($className), 'InvalidArgumentException', '$className is not allowed to be empty.');
        unset($this->packageModels[$className]);

        return $this;
    }

    /**
     * @param  array<mixed>  $models
     */
    public function addPackageModels(array $models): self
    {
        foreach ($models as $className => $meta) {
            $payload = [];
            if (! empty($className) && is_string($className) && is_array($meta)) {
                if (array_key_exists('className', $meta)
                    && ! empty($meta['className'])
                    && is_string($meta['className'])
                ) {
                    $payload['model'] = $meta['className'];
                } elseif (array_key_exists('model', $meta)
                    && ! empty($meta['model'])
                    && is_string($meta['model'])
                ) {
                    $payload['model'] = $meta['model'];
                } else {
                    $payload['model'] = $className;
                }

                $strings = [
                    'migration_date',
                    'migration_order',
                    'model_fqdn',
                    'model_column',
                    'model_label',
                    'model_attribute',
                    'model_plural',
                    'model_revision',
                    'model_singular',
                    'model_slug',
                    'model_slug_plural',
                    'name',
                    'namespace',
                    'organization',
                    'description',
                    'recipe',
                    'table',
                    'type',
                ];

                foreach ($strings as $string) {
                    if (array_key_exists($string, $meta)
                        && is_string($meta[$string])
                    ) {
                        $payload[$string] = $meta[$string];
                    }

                }

                if (array_key_exists('flavors', $meta) && is_array($meta['flavors'])) {
                    $payload['flavors'] = [];
                    foreach ($meta['flavors'] as $flavor) {
                        if (is_string($flavor) && ! in_array($flavor, $payload['flavors'])) {
                            $payload['flavors'][] = $flavor;
                        }
                    }
                }

                if (array_key_exists('playground', $meta)) {
                    $payload['playground'] = ! empty($meta['playground']);
                }
                if (array_key_exists('revision', $meta)) {
                    $payload['revision'] = ! empty($meta['revision']);
                }

                $this->addPackageModel($className, new PackageModel($payload));
            }
        }

        return $this;
    }

    public function packageModel(string $className): ?PackageModel
    {
        throw_if(empty($className), 'InvalidArgumentException', '$className is not allowed to be empty.');

        return $this->packageModels[$className] ?? null;
    }

    /**
     * @return array<string, PackageModel>
     */
    public function packageModels(): array
    {
        return $this->packageModels;
    }
}
