<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Models;

/**
 * \Playground\Make\Models\Recipe\Admin
 */
class Admin extends Playground
{
    protected array $ids = [
        'parent_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => null,
            ],
            'nullable' => true,
            'index' => true,
            'trait' => 'WithParent',
            'type' => 'uuid',
        ],
        'setting_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'admin_settings',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
    ];

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

    protected array $json = [
        'assets' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'meta' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'notes' => [
            'comment' => 'Array of note objects',
            'default' => '[]',
            'nullable' => true,
            'type' => 'JSON_ARRAY',
        ],
        'options' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'sources' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
    ];

    public function addFlags(): void
    {
        $this->flags['encrypted'] = [
            'icon' => 'fa-solid fa-language',
            'default' => false,
            'type' => 'boolean',
        ];

        $this->flags['secure'] = [
            'icon' => 'fa-solid fa-shield',
            'default' => false,
            'type' => 'boolean',
        ];
    }

    public function init(): void
    {
        $this->addFlags();
    }
}
