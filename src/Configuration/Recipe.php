<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration;

use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Recipe\Configuration\Recipe
 */
class Recipe extends PrimaryConfiguration
{
    protected string $description = '';

    protected string $slug = '';

    protected string $title = '';

    /**
     * @var array<string, Column>
     */
    protected array $columns = [];

    /**
     * @var array<string, Date>
     */
    protected array $dates = [];

    /**
     * @var array<string, string>
     */
    protected array $models = [];

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'class' => '',
        'slug' => '',
        'description' => '',
        'title' => '',
        'name' => '',
        'columns' => [],
        'dates' => [],
        'models' => [],
        'type' => '',
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (! empty($options['description'])
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

        if (! empty($options['slug'])
            && is_string($options['slug'])
        ) {
            $this->slug = strtolower($options['slug']);
        }

        if (! empty($options['title'])
            && is_string($options['title'])
        ) {
            $this->title = $options['title'];
        }

        if (! empty($options['dates']) && is_array($options['dates'])) {
            $this->addDates($options['dates']);
        }
        //        $this->addModels($options);

        return $this;
    }

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

    //    /**
    //     * @param  array<string, mixed>  $options
    //     */
    //    public function addModels(array $options): self
    //    {
    //        if (! empty($options['models'])
    //            && is_array($options['models'])
    //        ) {
    //            foreach ($options['models'] as $key => $file) {
    //                $this->addMappedClassTo('models', $key, $file);
    //            }
    //        }
    //
    //        return $this;
    //    }

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

    public function description(): string
    {
        return $this->description;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return array<string, string>
     */
    public function models(): array
    {
        return $this->models;
    }
}
