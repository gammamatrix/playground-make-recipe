<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\Json;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\JsonColumns
 */
trait JsonColumns
{
    /**
     * @var array<string, Json>
     */
    protected array $json = [];

    public function addJsonColumn(string $column, Json $json): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        $this->json[$column] = $json;
        $this->json[$column]->apply();

        return $this;
    }

    public function removeJson(string $column): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        unset($this->json[$column]);

        return $this;
    }

    /**
     * @param  array<mixed>  $json
     */
    public function addJsonColumns(array $json): self
    {
        foreach ($json as $column => $meta) {
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
                if (array_key_exists('comment', $meta)
                    && is_string($meta['comment'])
                ) {
                    $payload['comment'] = $meta['comment'];
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
                if (array_key_exists('default', $meta)
                    && is_string($meta['default'])
                ) {
                    $payload['default'] = $meta['default'];
                }
                if (array_key_exists('nullable', $meta)) {
                    $payload['nullable'] = ! empty($meta['nullable']);
                }
                if (array_key_exists('readOnly', $meta)) {
                    $payload['readOnly'] = ! empty($meta['readOnly']);
                }
                $this->addJsonColumn($column, new Json($payload));
            }
        }

        return $this;
    }

    public function jsonColumn(string $column): ?Json
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');

        return $this->json[$column] ?? null;
    }

    /**
     * @return array<string, Json>
     */
    public function json(): array
    {
        return $this->json;
    }
}
