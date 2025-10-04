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

    /**
     * @var array<string, string>
     */
    protected array $models = [];

    /**
     * @var array<string, mixed>
     */
    protected $properties = [
        // 'class' => '',
        // 'config' => '',
        // 'fqdn' => '',
        // 'model' => '',
        // 'model_fqdn' => '',
        // 'model_column' => '',
        // 'model_label' => '',
        // 'model_slug_plural' => '',
        'module' => '',
        'module_slug' => '',
        'name' => '',
        'description' => '',
        'namespace' => '',
        'organization' => '',
        'package' => '',
        // properties
        'models' => [],
        // 'folder' => '',
        'type' => '',
        // 'model_file' => '',
        // 'model_revision_file' => '',
        'model_package' => '',
        'controller_package' => '',
        // collection
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

        $this->addModels($options);

        return $this;
    }

    /**
     * @param  array<string, mixed>  $options
     */
    public function addModels(array $options): self
    {
        if (! empty($options['models'])
            && is_array($options['models'])
        ) {
            foreach ($options['models'] as $key => $file) {
                $this->addMappedClassTo('models', $key, $file);
            }
        }

        return $this;
    }

    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return array<string, string>
     */
    public function models(): array
    {
        return $this->models;
    }
}
