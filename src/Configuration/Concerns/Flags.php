<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\Flag;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Flags
 */
trait Flags
{
    /**
     * @var array<string, Flag>
     */
    protected array $flags = [];

    public function addFlag(string $column, Flag $flag): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        $this->flags[$column] = $flag;
        $this->flags[$column]->apply();

        return $this;
    }

    public function removeFlag(string $column): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        unset($this->flags[$column]);

        return $this;
    }

    /**
     * @param  array<mixed>  $flags
     */
    public function addFlags(array $flags): self
    {
        foreach ($flags as $column => $meta) {
            $payload = [];
            if (! empty($column) && is_string($column) && is_array($meta)) {
                if (array_key_exists('column', $meta)
                    && ! empty($meta['column'])
                    && is_string($meta['column'])
                ) {
                    $payload['column'] = $meta['column'];
                } else {
                    $payload['column'] = $column;
                }
                if (array_key_exists('description', $meta)
                    && is_string($meta['description'])
                ) {
                    $payload['description'] = $meta['description'];
                }
                if (array_key_exists('label', $meta)
                    && is_string($meta['label'])
                ) {
                    $payload['label'] = $meta['label'];
                }
                if (array_key_exists('icon', $meta)
                    && is_string($meta['icon'])
                ) {
                    $payload['icon'] = $meta['icon'];
                }
                if (array_key_exists('index', $meta)) {
                    $payload['index'] = ! empty($meta['index']);
                }
                if (array_key_exists('nullable', $meta)) {
                    $payload['nullable'] = ! empty($meta['nullable']);
                }
                if (array_key_exists('readOnly', $meta)) {
                    $payload['readOnly'] = ! empty($meta['readOnly']);
                }

                if (! empty($meta['exclude'])
                    && is_array($meta['exclude'])
                ) {
                    $payload['exclude'] = [];
                    foreach ($meta['exclude'] as $modelClassName) {
                        if (! empty($modelClassName) && is_string($modelClassName) && ! in_array($modelClassName, $payload['exclude'])) {
                            $payload['exclude'][] = $modelClassName;
                        }
                    }
                }

                if (! empty($meta['only'])
                    && is_array($meta['only'])
                ) {
                    $payload['only'] = [];
                    foreach ($meta['only'] as $modelClassName) {
                        if (! empty($modelClassName) && is_string($modelClassName) && ! in_array($modelClassName, $payload['only'])) {
                            $payload['only'][] = $modelClassName;
                        }
                    }
                }

                $this->addFlag($column, new Flag($payload));
            }
        }

        return $this;
    }

    public function flag(string $column): ?Flag
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');

        return $this->flags[$column] ?? null;
    }

    /**
     * @return array<string, Flag>
     */
    public function flags(): array
    {
        return $this->flags;
    }
}
