<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\Date;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Dates
 */
trait Dates
{
    /**
     * @var array<string, Date>
     */
    protected array $dates = [];

    public function addDate(string $column, Date $date): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        $this->dates[$column] = $date;
        $this->dates[$column]->apply();

        return $this;
    }

    public function removeDate(string $column): self
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');
        unset($this->dates[$column]);

        return $this;
    }

    /**
     * @param  array<mixed>  $dates
     */
    public function addDates(array $dates): self
    {
        foreach ($dates as $column => $meta) {
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
                if (array_key_exists('index', $meta)) {
                    $payload['index'] = ! empty($meta['index']);
                }
                if (array_key_exists('nullable', $meta)) {
                    $payload['nullable'] = ! empty($meta['nullable']);
                }
                if (array_key_exists('readOnly', $meta)) {
                    $payload['readOnly'] = ! empty($meta['readOnly']);
                }
                $this->addDate($column, new Date($payload));
            }
        }

        return $this;
    }

    public function date(string $column): ?Date
    {
        throw_if(empty($column), 'InvalidArgumentException', '$column is not allowed to be empty.');

        return $this->dates[$column] ?? null;
    }

    /**
     * @return array<string, Date>
     */
    public function dates(): array
    {
        return $this->dates;
    }
}
