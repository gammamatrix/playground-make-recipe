<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration;

use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Recipe\Configuration\Flag
 */
class Flag extends PrimaryConfiguration
{
    protected string $column = '';

    protected mixed $default = false;

    protected string $description = '';

    protected string $icon = '';

    protected bool $index = false;

    protected string $label = '';

    protected bool $nullable = false;

    protected bool $readOnly = false;

    /**
     * @var array{
     *     column: string,
     *     default: mixed,
     *     description: string,
     *     icon: string,
     *     index: bool,
     *     label: string,
     *     nullable: bool,
     *     readOnly: bool,
     * }
     */
    protected $properties = [
        'column' => '',
        'default' => false,
        'description' => '',
        'icon' => '',
        'index' => false,
        'label' => '',
        'nullable' => true,
        'readOnly' => true,
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (array_key_exists('column', $options)
            && is_string($options['column'])
        ) {
            $this->column = $options['column'];
        }

        if (array_key_exists('description', $options)
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

        if (array_key_exists('icon', $options)
            && is_string($options['icon'])
        ) {
            $this->icon = $options['icon'];
        }

        if (array_key_exists('label', $options)
            && is_string($options['label'])
        ) {
            $this->label = $options['label'];
        }

        if (array_key_exists('default', $options) && in_array(gettype($options['default']), [
            'boolean',
            'integer',
            'string',
            'NULL',
        ])) {
            $this->default = $options['default'];
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

    public function default(): mixed
    {
        return $this->default;
    }

    public function icon(): string
    {
        return $this->icon;
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

    public function readOnly(): bool
    {
        return $this->readOnly;
    }
}
