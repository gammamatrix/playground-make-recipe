<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Models;

/**
 * \Playground\Make\Models\Recipe\Cms
 */
class Cms extends Playground
{

    protected array $dates = [
        'canceled_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'closed_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'embargo_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'fixed_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'planned_end_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'planned_start_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'postponed_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'published_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'released_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'resumed_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'resolved_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'suspended_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'timer_end_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'timer_start_at' => [
            'nullable' => true,
            'index' => true,
        ],
    ];

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
        'page_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'cms_pages',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'snippet_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'cms_snippets',
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

}
