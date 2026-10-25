<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration;

use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Recipe\Configuration\Date
 */
class Date extends PrimaryConfiguration
{
    protected string $column = '';

    protected string $description = '';

    protected string $label = '';

    protected bool $index = false;

    protected bool $nullable = false;

    protected bool $readOnly = false;

    /**
     * @var string[]
     */
    protected array $exclude = [];

    /**
     * @var string[]
     */
    protected array $only = [];

    /**
     * @var array{
     *     column: string,
     *     description: string,
     *     label: string,
     *     index: bool,
     *     nullable: bool,
     *     readOnly: bool,
     *     exclude: string[],
     *     only: string[],
     * }
     */
    protected $properties = [
        'column' => '',
        'description' => '',
        'label' => '',
        'index' => false,
        'nullable' => true,
        'readOnly' => false,
        'exclude' => [],
        'only' => [],
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (array_key_exists('column', $options)
            && ! empty($options['column'])
            && is_string($options['column'])
        ) {
            $this->column = $options['column'];
        }

        if (array_key_exists('description', $options)
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

        if (array_key_exists('label', $options)
            && is_string($options['label'])
        ) {
            $this->label = $options['label'];
        }

        if (array_key_exists('index', $options)) {
            $this->index = ! empty($options['index']);
        }

        if (array_key_exists('nullable', $options)) {
            $this->nullable = ! empty($options['nullable']);
        }

        if (array_key_exists('readOnly', $options)) {
            $this->readOnly = ! empty($options['readOnly']);
        }

        if (array_key_exists('exclude', $options)) {
            if (empty($options['exclude'])) {
                $this->exclude = [];
            } elseif (is_array($options['exclude'])) {
                $exclude = [];
                foreach ($options['exclude'] as $modelClassName) {
                    if (! empty($modelClassName) && is_string($modelClassName) && ! in_array($modelClassName, $exclude)) {
                        $exclude[] = $modelClassName;
                    }
                }
                $this->exclude = $exclude;
            }
        }

        if (array_key_exists('only', $options)) {
            if (empty($options['only'])) {
                $this->only = [];
            } elseif (is_array($options['only'])) {
                $only = [];
                foreach ($options['only'] as $modelClassName) {
                    if (! empty($modelClassName) && is_string($modelClassName) && ! in_array($modelClassName, $only)) {
                        $only[] = $modelClassName;
                    }
                }
                $this->only = $only;
            }
        }

        return $this;
    }

    public function column(): string
    {
        return $this->column;
    }

    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return string[]
     */
    public function exclude(): array
    {
        return $this->exclude;
    }

    public function label(): string
    {
        return $this->label;
    }

    public function index(): bool
    {
        return $this->index;
    }

    public function nullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @return string[]
     */
    public function only(): array
    {
        return $this->only;
    }

    public function readOnly(): bool
    {
        return $this->readOnly;
    }
}
