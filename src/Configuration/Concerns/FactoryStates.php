<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\FactoryState;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\FactoryStates
 */
trait FactoryStates
{
    /**
     * @var array<string, FactoryState>
     */
    protected array $factoryStates = [];

    public function addFactoryState(string $column, FactoryState $factoryState): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        $this->factoryStates[$column] = $factoryState;
        $this->factoryStates[$column]->apply();

        return $this;
    }

    public function removeFactoryState(string $column): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        unset($this->factoryStates[$column]);

        return $this;
    }

    /**
     * @param  array<mixed>  $factoryStates
     */
    public function addFactoryStates(array $factoryStates): self
    {
        foreach ($factoryStates as $column => $meta) {
            $payload = [];
            if (! empty($column) && is_string($column) && is_array($meta)) {
                if (array_key_exists('state', $meta)
                    && is_string($meta['state'])
                ) {
                    $payload['state'] = $meta['state'];
                } else {
                    $payload['column'] = $column;
                }
                if (array_key_exists('description', $meta)
                    && is_string($meta['description'])
                ) {
                    $payload['description'] = $meta['description'];
                }
                if (array_key_exists('type', $meta)
                    && is_string($meta['type'])
                ) {
                    $payload['type'] = $meta['type'];
                }
                if (array_key_exists('value', $meta)) {
                    $payload['value'] = $meta['value'];
                }
                $this->addFactoryState($column, new FactoryState($payload));
            }
        }

        return $this;
    }

    public function factoryState(string $column): ?FactoryState
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');

        return $this->factoryStates[$column] ?? null;
    }

    /**
     * @return array<string, FactoryState>
     */
    public function factoryStates(): array
    {
        return $this->factoryStates;
    }
}
