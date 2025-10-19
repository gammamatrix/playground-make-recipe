<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Configuration;

use Illuminate\Support\Facades\Log;
use Playground\Make\Configuration\PrimaryConfiguration;

/**
 * \Playground\Make\Recipe\Configuration\FactoryState
 */
class FactoryState extends PrimaryConfiguration
{
    protected string $description = '';

    protected string $type = '';

    protected mixed $value = null;

    /**
     * @var array{
     *     description: string,
     *     type: string,
     *     value: mixed,
     * }
     */
    protected $properties = [
        'description' => '',
        'type' => '',
        'value' => null,
    ];

    /** @var string[] */
    protected array $allowed_types = [
        'flag',
    ];

    /**
     * @param  array<string, mixed>  $options
     */
    public function setOptions(array $options = []): self
    {
        parent::setOptions($options);

        if (array_key_exists('description', $options)
            && is_string($options['description'])
        ) {
            $this->description = $options['description'];
        }

        if (array_key_exists('type', $options)
            && is_string($options['type'])
        ) {
            if (! in_array($this->type, $this->allowed_types)) {
                Log::warning(__('playground-make-recipe::building.FactoryState.type.unexpected', [
                    'type' => $this->type,
                    'allowed' => implode(', ', $this->allowed_types),
                ]));
            } else {
                $this->type = $options['type'];
            }
        }

        if (array_key_exists('value', $options)) {
            if (is_string($options['value'])) {
                if (strtolower($options['value']) === 'true') {
                    $this->value = true;
                } elseif (strtolower($options['value']) === 'false') {
                    $this->value = false;
                } elseif (strtolower($options['value']) === 'null') {
                    $this->value = null;
                } elseif ($options['value'] === '[]') {
                    $this->value = [];
                } elseif ($options['value'] === '{}') {
                    $this->value = [];
                }
            } else {
                $this->value = $options['value'];
            }
        }

        return $this;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function value(): mixed
    {
        return $this->value;
    }
}
