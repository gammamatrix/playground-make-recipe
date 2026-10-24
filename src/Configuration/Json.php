<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration;

use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Recipe\Configuration\Json
 */
class Json extends PrimaryConfiguration
{
    protected string $column = '';

    protected string $comment = '';

    protected mixed $default = null;

    protected string $description = '';

    protected string $label = '';

    protected string $type = 'JSON_OBJECT';

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
     *     comment: string,
     *     default: mixed,
     *     description: string,
     *     label: string,
     *     type: 'JSON_ARRAY'|'JSON_OBJECT',
     *     nullable: bool,
     *     readOnly: bool,
     *     exclude: string[],
     *     only: string[],
     * }
     */
    protected $properties = [
        'column' => '',
        'comment' => '',
        'default' => null,
        'description' => '',
        'label' => '',
        'type' => 'JSON_OBJECT',
        'nullable' => true,
        'readOnly' => true,
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
            && is_string($options['column'])
        ) {
            $this->column = $options['column'];
        }

        if (array_key_exists('comment', $options)
            && is_string($options['comment'])
        ) {
            $this->comment = $options['comment'];
        }

        if (array_key_exists('description', $options)
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

        if (array_key_exists('type', $options)
            && is_string($options['type'])
            && in_array($options['type'], ['JSON_ARRAY', 'JSON_OBJECT'])
        ) {
            $this->type = $options['type'];
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
                foreach ($options['exclude'] as $modelClassName) {
                    if (! empty($modelClassName) && is_string($modelClassName) && ! in_array($modelClassName, $this->exclude)) {
                        $this->exclude[] = $modelClassName;
                    }
                }
            }
        }

        if (array_key_exists('only', $options)) {
            if (empty($options['only'])) {
                $this->only = [];
            } elseif (is_array($options['only'])) {
                foreach ($options['only'] as $modelClassName) {
                    if (! empty($modelClassName) && is_string($modelClassName) && ! in_array($modelClassName, $this->only)) {
                        $this->only[] = $modelClassName;
                    }
                }
            }
        }

        // dump([
        //    '__METHOD__' => __METHOD__,
        //     '$options' => $options,
        //     '$options[type]' => $options['type'] ?? null,
        //     '$this->column' => $this->column,
        //     '$this->type' => $this->type,
        //    '$this' => $this,
        // ]);
        return $this;
    }

    public function column(): string
    {
        return $this->column;
    }

    public function comment(): string
    {
        return $this->comment;
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

    public function default(): mixed
    {
        return $this->default;
    }

    public function label(): string
    {
        return $this->label;
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
