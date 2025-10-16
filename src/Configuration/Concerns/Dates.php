<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration\Concerns;

use Playground\Make\Recipe\Configuration\Date;

/**
 * \Playground\Make\Recipe\Configuration\Concerns\Columns
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
            $date = [];
            if (! empty($column) && is_string($column) && is_array($meta)) {
                if (array_key_exists('column', $meta)
                    && ! empty($meta['column'])
                    && is_string($meta['column'])
                ) {
                    $date['column'] = $meta['column'];
                } else {
                    $date['column'] = $column;
                }
                if (array_key_exists('description', $meta)
                    && ! empty($meta['description'])
                    && is_string($meta['description'])
                ) {
                    $date['description'] = $meta['description'];
                }
                if (array_key_exists('label', $meta)
                    && ! empty($meta['label'])
                    && is_string($meta['label'])
                ) {
                    $date['label'] = $meta['label'];
                }
                if (array_key_exists('index', $meta)) {
                    $date['index'] = ! empty($meta['index']);
                }
                if (array_key_exists('nullable', $meta)) {
                    $date['nullable'] = ! empty($meta['nullable']);
                }
                $this->addDate($column, new Date($date));
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
