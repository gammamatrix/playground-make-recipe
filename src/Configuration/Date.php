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
class Date extends PrimaryConfiguration
{
    protected string $column = '';

    protected string $description = '';

    protected string $label = '';

    protected bool $index = false;

    protected bool $nullable = false;

    /**
     * @var array{
     *     column: string,
     *     description: string,
     *     label: string,
     *     index: bool,
     *     nullable: bool,
     * }
     */
    protected $properties = [
        'column' => '',
        'description' => '',
        'label' => '',
        'index' => false,
        'nullable' => true,
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
}
