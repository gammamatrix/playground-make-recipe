<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\Id;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Ids
 */
trait Ids
{
    /**
     * @var array<string, Id>
     */
    protected array $ids = [];

    public function addId(string $column_slug, Id $id): self
    {
        throw_if(empty($column_slug), 'InvalidArgumentException', '$column_slug is not allowed to be empty.');
        $this->ids[$column_slug] = $id;
        $this->ids[$column_slug]->apply();

        return $this;
    }

    public function removeId(string $column): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        unset($this->ids[$column]);

        return $this;
    }

    /**
     * @param  array<mixed>  $ids
     */
    public function addIds(array $ids): self
    {
        foreach ($ids as $column => $meta) {
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
                if (array_key_exists('local_key', $meta)
                    && ! empty($meta['local_key'])
                    && is_string($meta['local_key'])
                ) {
                    $payload['local_key'] = $meta['local_key'];
                }
                if (array_key_exists('accessor', $meta)
                    && ! empty($meta['accessor'])
                    && is_string($meta['accessor'])
                ) {
                    $payload['accessor'] = $meta['accessor'];
                }
                if (array_key_exists('related', $meta)
                    && ! empty($meta['related'])
                    && is_string($meta['related'])
                ) {
                    $payload['related'] = $meta['related'];
                }
                if (array_key_exists('foreign_key', $meta)
                    && ! empty($meta['foreign_key'])
                    && is_string($meta['foreign_key'])
                ) {
                    $payload['foreign_key'] = $meta['foreign_key'];
                }
                if (array_key_exists('references', $meta)
                    && ! empty($meta['references'])
                    && is_string($meta['references'])
                ) {
                    $payload['references'] = $meta['references'];
                }
                if (array_key_exists('on', $meta)
                    && ! empty($meta['on'])
                    && is_string($meta['on'])
                ) {
                    $payload['on'] = $meta['on'];
                }
                if (array_key_exists('type', $meta)
                    && ! empty($meta['type'])
                    && is_string($meta['type'])
                ) {
                    $payload['type'] = $meta['type'];
                }
                if (array_key_exists('comment', $meta)
                    && ! empty($meta['comment'])
                    && is_string($meta['comment'])
                ) {
                    $payload['comment'] = $meta['comment'];
                }
                if (array_key_exists('description', $meta)
                    && ! empty($meta['description'])
                    && is_string($meta['description'])
                ) {
                    $payload['description'] = $meta['description'];
                }
                if (array_key_exists('label', $meta)
                    && ! empty($meta['label'])
                    && is_string($meta['label'])
                ) {
                    $payload['label'] = $meta['label'];
                }
                if (array_key_exists('default', $meta)
                    && is_string($meta['default'])
                ) {
                    $payload['default'] = $meta['default'];
                }
                if (array_key_exists('icon', $meta)
                    && is_string($meta['icon'])
                ) {
                    $payload['icon'] = $meta['icon'];
                }
                if (array_key_exists('size', $meta)
                    && (is_numeric($meta['size']) || is_null($meta['size']))
                ) {
                    $payload['size'] = $meta['size'];
                }
                if (array_key_exists('html', $meta)) {
                    $payload['html'] = ! empty($meta['html']);
                }
                if (array_key_exists('index', $meta)) {
                    $payload['index'] = ! empty($meta['index']);
                }
                if (array_key_exists('nullable', $meta)) {
                    $payload['nullable'] = ! empty($meta['nullable']);
                }
                if (array_key_exists('unsigned', $meta)) {
                    $payload['unsigned'] = ! empty($meta['unsigned']);
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

                $this->addId($column, new Id($payload));
            }
        }

        return $this;
    }

    public function id(string $column): ?Id
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');

        return $this->ids[$column] ?? null;
    }

    /**
     * @return array<string, Id>
     */
    public function ids(): array
    {
        return $this->ids;
    }
}
