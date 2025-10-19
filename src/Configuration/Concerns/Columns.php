<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\Column;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Columns
 */
trait Columns
{
    /**
     * @var array<string, Column>
     */
    protected array $columns = [];

    public function addColumn(string $column_slug, Column $column): self
    {
        throw_if(empty($column_slug), 'InvalidArgumentException', '$column_slug is not allowed to be empty.');
        $this->columns[$column_slug] = $column;
        $this->columns[$column_slug]->apply();

        return $this;
    }

    public function removeColumn(string $column_slug): self
    {
        throw_if(empty($column_slug), 'InvalidArgumentException', '$column_slug is not allowed to be empty.');
        unset($this->columns[$column_slug]);

        return $this;
    }

    /**
     * @param  array<mixed>  $columns
     */
    public function addColumns(array $columns): self
    {
        foreach ($columns as $column_slug => $meta) {
            $column = [];
            if (! empty($column_slug) && is_string($column_slug) && is_array($meta)) {
                if (array_key_exists('column', $meta)
                    && ! empty($meta['column'])
                    && is_string($meta['column'])
                ) {
                    $column['column'] = $meta['column'];
                } else {
                    $column['column'] = $column_slug;
                }
                if (array_key_exists('description', $meta)
                    && ! empty($meta['description'])
                    && is_string($meta['description'])
                ) {
                    $column['description'] = $meta['description'];
                }
                if (array_key_exists('label', $meta)
                    && ! empty($meta['label'])
                    && is_string($meta['label'])
                ) {
                    $column['label'] = $meta['label'];
                }
                if (array_key_exists('index', $meta)) {
                    $column['index'] = ! empty($meta['index']);
                }
                if (array_key_exists('nullable', $meta)) {
                    $column['nullable'] = ! empty($meta['nullable']);
                }
                $this->addColumn($column_slug, new Column($column));
            }
        }

        return $this;
    }

    public function column(string $column_slug): ?Column
    {
        throw_if(empty($column_slug), 'InvalidArgumentException', '$column_slug is not allowed to be empty.');

        return $this->columns[$column_slug] ?? null;
    }

    /**
     * @return array<string, Column>
     */
    public function columns(): array
    {
        return $this->columns;
    }
}
