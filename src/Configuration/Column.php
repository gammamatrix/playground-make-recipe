<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration;

use Illuminate\Support\Facades\Log;
use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Recipe\Configuration\Column
 */
class Column extends PrimaryConfiguration
{
    protected string $column = '';

    protected string $comment = '';

    /**
     * @var string The description will be used for comments and documentation.
     */
    protected string $description = '';

    protected string $label = '';

    protected string $icon = '';

    protected bool $html = false;

    protected bool $index = false;

    protected ?int $precision = null;

    protected ?int $scale = null;

    protected ?int $size = null;

    protected bool $nullable = false;

    protected bool $readOnly = false;

    protected string $type = 'string';

    protected mixed $default = null;

    protected bool $hasDefault = false;

    protected bool $unsigned = false;

    /**
     * @var array{
     *     column: string,
     *     default: mixed,
     *     description: string,
     *     hasDefault: bool,
     *     html: bool,
     *     icon: string,
     *     index: bool,
     *     label: string,
     *     nullable: bool,
     *     precision: int|null,
     *     readOnly: bool,
     *     scale: int|null,
     *     size: int|null,
     *     type: string,
     * }
     */
    protected $properties = [
        'column' => '',
        'default' => null,
        'description' => '',
        'hasDefault' => false,
        'html' => false,
        'icon' => '',
        'index' => false,
        'label' => '',
        'nullable' => false,
        'precision' => null,
        'readOnly' => false,
        'scale' => null,
        'size' => null,
        'type' => 'string',
    ];

    /**
     * @var string[]
     */
    public array $allowed_types = [
        'uuid',
        'ulid',
        'string',
        'char',
        'smallText',
        'mediumText',
        'text',
        'longText',
        'boolean',
        'integer',
        'bigInteger',
        'mediumInteger',
        'smallInteger',
        'tinyInteger',
        'dateTime',
        'decimal',
        'float', // double
    ];

    /**
     * @return string[]
     */
    public function allowedTypes(): array
    {
        return $this->allowed_types;
    }

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (! empty($options['column'])
            && is_string($options['column'])
        ) {
            $this->column = $options['column'];
        }

        if (! empty($options['type'])
            && is_string($options['type'])
        ) {
            if (! in_array($options['type'], $this->allowed_types)) {
                Log::warning(__('playground-make-recipe::building.Column.type.unexpected', [
                    'column' => $this->column,
                    'type' => $this->type,
                    'allowed' => implode(', ', $this->allowed_types),
                ]));
            } else {
                $this->type = $options['type'];
            }
        }

        if (in_array($this->type, [
            'integer',
            'bigInteger',
            'mediumInteger',
            'smallInteger',
            'tinyInteger',
        ])) {
            if (array_key_exists('unsigned', $options)) {
                $this->unsigned = ! empty($options['unsigned']);
            }

            $this->properties['unsigned'] = $this->unsigned;
        }

        if (in_array($this->type, [
            'decimal',
            'float',
            'double',
        ])) {
            if (! empty($options['precision'])
                && is_numeric($options['precision'])
                && $options['precision'] > 0
            ) {
                $this->precision = intval($options['precision']);
            }

            $this->properties['precision'] = $this->precision;

            if (! empty($options['scale'])
                && is_numeric($options['scale'])
                && $options['scale'] > 0
            ) {
                $this->scale = intval($options['scale']);
            }

            $this->properties['scale'] = $this->scale;
        }

        if (in_array($this->type, [
            'char',
            'string',
        ])) {
            if (! empty($options['size'])
                && is_numeric($options['size'])
                && $options['size'] > 0
            ) {
                $this->size = intval($options['size']);
                $this->properties['size'] = $this->size;
            }
        }

        if (array_key_exists('html', $options)) {
            $this->html = ! empty($options['html']);
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

        if (! empty($options['comment']) && is_string($options['comment'])) {
            $this->comment = $options['comment'];
            $this->properties['comment'] = $this->comment;
        }

        if (array_key_exists('default', $options)) {
            $this->hasDefault = true;
            // TODO: Place restrictions on the default?
            $this->default = $options['default'];
            $this->properties['default'] = $this->default;
        }

        if (! empty($options['column'])
            && is_string($options['column'])
        ) {
            $this->column = $options['column'];
        }

        if (! empty($options['label'])
            && is_string($options['label'])
        ) {
            $this->label = $options['label'];
        }

        if (! empty($options['icon'])
            && is_string($options['icon'])
        ) {
            $this->icon = $options['icon'];
        }

        if (! empty($options['description'])
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

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

    public function label(): string
    {
        return $this->label;
    }

    public function default(): mixed
    {
        return $this->default;
    }

    public function hasDefault(): bool
    {
        return $this->hasDefault;
    }

    public function icon(): string
    {
        return $this->icon;
    }

    public function html(): bool
    {
        return $this->html;
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

    public function precision(): ?int
    {
        return $this->precision;
    }

    public function scale(): ?int
    {
        return $this->scale;
    }

    public function unsigned(): bool
    {
        return $this->unsigned;
    }
}
