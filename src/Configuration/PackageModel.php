<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration;

use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Recipe\Configuration\Model
 */
class PackageModel extends PrimaryConfiguration
{
    protected string $description = '';

    /**
     * @var string[]
     */
    protected array $flavors = [];

    protected string $model_attribute = '';

    protected string $model_column = '';

    protected string $model_revision = '';

    protected string $model_label = '';

    protected string $model_plural = '';

    protected string $model_singular = '';

    protected string $model_slug = '';

    protected string $model_slug_plural = '';

    protected string $recipe = '';

    protected string $table = '';

    protected bool $revision = false;

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        'model' => '',
        'model_fqdn' => '',
        'model_column' => '',
        'model_label' => '',
        'model_attribute' => '',
        'model_plural' => '',
        'model_revision' => '',
        'model_singular' => '',
        'model_slug' => '',
        'model_slug_plural' => '',
        'name' => '',
        'namespace' => '',
        'organization' => '',
        'description' => '',
        'recipe' => '',
        'table' => '',
        'type' => '',
        'playground' => false,
        'revision' => false,
        'HasOne' => [],
        'HasMany' => [],
        'columns' => [],
        'dates' => [],
        'factoryStates' => [],
        'flags' => [],
        'flavors' => [],
        'json' => [],
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        // TODO verify we want all these options
        if (! empty($options['model_column'])
            && is_string($options['model_column'])
        ) {
            $this->model_column = $options['model_column'];
        }

        if (! empty($options['model_label'])
            && is_string($options['model_label'])
        ) {
            $this->model_label = $options['model_label'];
        }

        if (! empty($options['model_attribute'])
            && is_string($options['model_attribute'])
        ) {
            $this->model_attribute = $options['model_attribute'];
        }

        if (! empty($options['model_plural'])
            && is_string($options['model_plural'])
        ) {
            $this->model_plural = $options['model_plural'];
        }

        if (! empty($options['model_revision'])
            && is_string($options['model_revision'])
        ) {
            $this->model_revision = $options['model_revision'];
        }

        if (! empty($options['model_singular'])
            && is_string($options['model_singular'])
        ) {
            $this->model_singular = $options['model_singular'];
        }

        if (! empty($options['model_slug'])
            && is_string($options['model_slug'])
        ) {
            $this->model_slug = $options['model_slug'];
        }

        if (! empty($options['model_slug_plural'])
            && is_string($options['model_slug_plural'])
        ) {
            $this->model_slug_plural = $options['model_slug_plural'];
        }

        if (! empty($options['description'])
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

        if (! empty($options['recipe'])
            && is_string($options['recipe'])
        ) {
            $this->recipe = $options['recipe'];
        }

        if (! empty($options['table'])
            && is_string($options['table'])
        ) {
            $this->table = $options['table'];
        }

        if (array_key_exists('revision', $options)) {
            $this->revision = ! empty($options['revision']);
        }

        if (! empty($options['flavors'])
            && is_array($options['flavors'])
        ) {
            $this->setFlavors($options['flavors']);
        }

        return $this;
    }

    /**
     * @param  array<mixed>  $flavors
     */
    public function setFlavors(array $flavors): self
    {
        $this->flavors = [];
        foreach ($flavors as $flavor) {
            if (is_string($flavor)) {
                $this->addFlavor($flavor);
            }
        }

        return $this;
    }

    public function addFlavor(string $flavor): self
    {
        if (! empty($flavor) && ! in_array($flavor, $this->flavors)) {
            $this->flavors[] = $flavor;
        }

        return $this;
    }

    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return string[]
     */
    public function flavors(): array
    {
        return $this->flavors;
    }

    public function model_column(): string
    {
        return $this->model_column;
    }

    public function model_label(): string
    {
        return $this->model_label;
    }

    public function model_attribute(): string
    {
        return $this->model_attribute;
    }

    public function model_plural(): string
    {
        return $this->model_plural;
    }

    public function model_revision(): string
    {
        return $this->model_revision;
    }

    public function model_singular(): string
    {
        return $this->model_singular;
    }

    public function model_slug(): string
    {
        return $this->model_slug;
    }

    public function model_slug_plural(): string
    {
        return $this->model_slug_plural;
    }

    public function recipe(): string
    {
        return $this->recipe;
    }

    public function table(): string
    {
        return $this->table;
    }

    public function revision(): bool
    {
        return $this->revision;
    }
}
