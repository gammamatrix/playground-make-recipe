<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Admin
 */
class Admin extends Playground
{
    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $allIds = [
        'parent_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => null,
            ],
            'index' => true,
            'nullable' => true,
            'trait' => 'WithParent',
            'type' => 'uuid',
        ],
        'matrix_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_matrices',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'setting_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'admin_settings',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $factoryStates = [
        'locked' => [
            'type' => 'flag',
            'value' => true,
        ],
        'published' => [
            'type' => 'flag',
            'value' => true,
        ],
    ];

    public function addDates(): void
    {
        $this->dates['fixed_at'] = [
            'label' => 'Fixed at',
            'nullable' => true,
        ];

        ksort($this->dates);
    }

    public function addFlags(): void
    {
        $this->flags['encrypted'] = [
            'icon' => 'fa-solid fa-language',
            'default' => false,
            'label' => 'Encrypted',
            'type' => 'boolean',
        ];

        $this->flags['secure'] = [
            'icon' => 'fa-solid fa-shield',
            'default' => false,
            'label' => 'Secure',
            'type' => 'boolean',
        ];

        ksort($this->flags);
    }

    public function init(): void
    {
        $this->addDates();
        $this->addFlags();
    }
}
