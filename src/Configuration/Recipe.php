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
    use Concerns\Columns;
    use Concerns\Dates;
    use Concerns\Flags;

    protected string $description = '';

    protected string $slug = '';

    protected string $title = '';

    /**
     * @var array<string, string>
     */
    protected array $models = [];

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'class' => '',
        'extends' => 'Playground',
        'extends_use' => '',
        'slug' => '',
        'description' => '',
        'title' => '',
        'name' => '',
        'columns' => [],
        'dates' => [],
        'flags' => [],
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

        if (! empty($options['columns']) && is_array($options['columns'])) {
            $this->addColumns($options['columns']);
        }

        if (! empty($options['dates']) && is_array($options['dates'])) {
            $this->addDates($options['dates']);
        }

        if (! empty($options['flags']) && is_array($options['flags'])) {
            $this->addFlags($options['flags']);
        }
        //        $this->addModels($options);

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
