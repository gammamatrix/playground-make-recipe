<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\Flag;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Columns
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
            $flag = [];
            if (! empty($column) && is_string($column) && is_array($meta)) {
                if (array_key_exists('column', $meta)
                    && ! empty($meta['column'])
                    && is_string($meta['column'])
                ) {
                    $flag['column'] = $meta['column'];
                } else {
                    $flag['column'] = $column;
                }
                if (array_key_exists('description', $meta)
                    && is_string($meta['description'])
                ) {
                    $flag['description'] = $meta['description'];
                }
                if (array_key_exists('label', $meta)
                    && is_string($meta['label'])
                ) {
                    $flag['label'] = $meta['label'];
                }
                if (array_key_exists('icon', $meta)
                    && is_string($meta['icon'])
                ) {
                    $flag['icon'] = $meta['icon'];
                }
                if (array_key_exists('index', $meta)) {
                    $flag['index'] = ! empty($meta['index']);
                }
                if (array_key_exists('nullable', $meta)) {
                    $flag['nullable'] = ! empty($meta['nullable']);
                }
                $this->addFlag($column, new Flag($flag));
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
