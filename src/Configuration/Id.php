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
class Id extends PrimaryConfiguration
{
    protected string $column = '';

    protected string $local_key = '';

    protected string $accessor = '';

    protected string $related = '';

    protected string $foreign_key = '';

    protected string $references = '';

    protected string $on = '';

    protected string $comment = '';

    /**
     * @var string The description will be used for comments and documentation.
     */
    protected string $description = '';

    protected string $label = '';

    protected string $icon = '';

    protected bool $index = false;

    protected ?int $size = null;

    protected bool $nullable = false;

    protected string $type = 'uuid';

    protected mixed $default = null;

    protected bool $hasDefault = false;

    protected bool $unsigned = false;

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
     *     accessor: string,
     *     column: string,
     *     foreign_key: string,
     *     local_key: string,
     *     on: string,
     *     references: string,
     *     related: string,
     *     default: mixed,
     *     description: string,
     *     hasDefault: bool,
     *     icon: string,
     *     index: bool,
     *     label: string,
     *     nullable: bool,
     *     unsigned: bool,
     *     size: int|null,
     *     type: string,
     *     exclude: string[],
     *     only: string[],
     * }
     */
    protected $properties = [
        'accessor' => '',
        'column' => '',
        'local_key' => '',
        'foreign_key' => '',
        'on' => '',
        'references' => '',
        'related' => '',
        'default' => null,
        'description' => '',
        'hasDefault' => false,
        'icon' => '',
        'index' => false,
        'label' => '',
        'nullable' => false,
        'unsigned' => false,
        'size' => null,
        'type' => 'uuid',
        'exclude' => [],
        'only' => [],
    ];

    /**
     * @var string[]
     */
    public array $allowed_types = [
        'uuid',
        'ulid',
        'string',
        'char',
        'integer',
        'bigInteger',
        'mediumInteger',
        'smallInteger',
        'tinyInteger',
        'dateTime',
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

        if (! empty($options['local_key'])
            && is_string($options['local_key'])
        ) {
            $this->local_key = $options['local_key'];
        }

        if (! empty($options['accessor'])
            && is_string($options['accessor'])
        ) {
            $this->accessor = $options['accessor'];
        }

        if (! empty($options['related'])
            && is_string($options['related'])
        ) {
            // TODO format related?
            $this->related = $options['related'];
        }

        if (! empty($options['foreign_key'])
            && is_string($options['foreign_key'])
        ) {
            $this->foreign_key = $options['foreign_key'];
        }

        if (! empty($options['references'])
            && is_string($options['references'])
        ) {
            $this->references = $options['references'];
        }

        if (! empty($options['on'])
            && is_string($options['on'])
        ) {
            $this->on = $options['on'];
        }

        if (! empty($options['type'])
            && is_string($options['type'])
        ) {
            if (! in_array($options['type'], $this->allowed_types)) {
                Log::warning(__('playground-make-recipe::building.Id.type.unexpected', [
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

        if (array_key_exists('index', $options)) {
            $this->index = ! empty($options['index']);
        }

        if (array_key_exists('nullable', $options)) {
            $this->nullable = ! empty($options['nullable']);
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

    public function accessor(): string
    {
        return $this->accessor;
    }

    public function column(): string
    {
        return $this->column;
    }

    public function local_key(): string
    {
        return $this->local_key;
    }

    public function related(): string
    {
        return $this->related;
    }

    public function foreign_key(): string
    {
        return $this->foreign_key;
    }

    public function references(): string
    {
        return $this->references;
    }

    public function on(): string
    {
        return $this->on;
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

    /**
     * @return string[]
     */
    public function exclude(): array
    {
        return $this->exclude;
    }

    public function hasDefault(): bool
    {
        return $this->hasDefault;
    }

    public function icon(): string
    {
        return $this->icon;
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

    public function size(): ?int
    {
        return $this->size;
    }

    public function unsigned(): bool
    {
        return $this->unsigned;
    }
}
