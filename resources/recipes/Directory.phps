<?php

/**
 * 
 */

declare(strict_types=1);

namespace Playground\Make\Models;


/**
 * \Playground\Make\Models\Directory
 */
class Directory extends Playground
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

    protected array $factoryState = [
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
        'address' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'assets' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'contact' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'meta' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'notes' => [
            'comment' => 'Array of note objects',
            'default' => '[]',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
    ];

}
