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
     * Includes:
     * - active
     * - canceled
     * - canceled_at
     * - closed
     * - closed_at
     * - pending
     * - problem
     * - resolved
     * - resolved_at
     * - resumed_at
     * - retired
     * - suspended
     * - suspended_at
     * - unknown
     */
    protected bool $withLifecycle = false;

    /**
     * Includes:
     * - x
     * - y
     * - z
     * - r
     * - theta
     * - rho
     * - phi
     * - elevation
     * - latitude
     * - longitude
     * - matrix
     */
    protected bool $withMatrix = false;

    /**
     * Includes:
     * - gids
     * - po
     * - pg
     * - pw
     * - locked
     * - only_admin
     * - only_user
     * - only_guest
     * - allow_public
     */
    protected bool $withPermissions = false;

    /**
     * Includes:
     * - timer_start_at
     * - timer_end_at
     * - planned
     * - planned_start_at
     * - planned_end_at
     * - postponed_at
     * - prioritized
     */
    protected bool $withPlanning = false;

    /**
     * Includes:
     * - embargo_at
     * - published
     * - published_at
     * - released
     * - released_at
     */
    protected bool $withPublishing = false;

    /**
     * Includes:
     * - rank
     * - size
     * - status
     */
    protected bool $withStatus = false;

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
        'playground' => false,
        'withLifecycle' => false,
        'withMatrix' => false,
        'withPermissions' => false,
        'withPlanning' => false,
        'withPublishing' => false,
        'withStatus' => false,
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

        if (array_key_exists('withLifecycle', $options)) {
            $this->withLifecycle = ! empty($options['withLifecycle']);
        }

        if (array_key_exists('withMatrix', $options)) {
            $this->withMatrix = ! empty($options['withMatrix']);
        }

        if (array_key_exists('withPermissions', $options)) {
            $this->withPermissions = ! empty($options['withPermissions']);
        }

        if (array_key_exists('withPlanning', $options)) {
            $this->withPlanning = ! empty($options['withPlanning']);
        }

        if (array_key_exists('withPublishing', $options)) {
            $this->withPublishing = ! empty($options['withPublishing']);
        }

        if (array_key_exists('withStatus', $options)) {
            $this->withStatus = ! empty($options['withStatus']);
        }

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

    public function withLifecycle(): bool
    {
        return $this->withLifecycle;
    }

    public function withMatrix(): bool
    {
        return $this->withMatrix;
    }

    public function withPermissions(): bool
    {
        return $this->withPermissions;
    }

    public function withPlanning(): bool
    {
        return $this->withPlanning;
    }

    public function withPublishing(): bool
    {
        return $this->withPublishing;
    }

    public function withStatus(): bool
    {
        return $this->withStatus;
    }
}
