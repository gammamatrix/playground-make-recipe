<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Crm
 */
class Crm extends Playground
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
        'resolved_at' => [
            'nullable' => true,
            'index' => true,
        ],
        'resumed_at' => [
            'nullable' => true,
            'index' => false,
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
        'client_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'crm_clients',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'contact_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'crm_contacts',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'location_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'crm_locations',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'organization_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'crm_organizations',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'people_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'crm_people',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
    ];

    protected array $factoryStates = [
        'locked' => [
            'type' => 'flag',
            'value' => true,
        ],
        'featured' => [
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
            'readOnly' => true,
            'type' => 'JSON_ARRAY',
        ],
        'options' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'sources' => [
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
    ];

    public function addColumns(): void
    {
        $this->columns['email'] = [
            'nullable' => true,
            'type' => 'string',
        ];

        $this->columns['phone'] = [
            'nullable' => true,
            'type' => 'string',
        ];
    }

    public function addFlags(): void
    {
        $this->flags['featured'] = [
            'icon' => 'fa-solid fa-star text-primary',
            'default' => false,
            'type' => 'boolean',
        ];

        $this->flags['sms'] = [
            'icon' => 'fa-solid fa-comment-sms',
            'default' => false,
            'type' => 'boolean',
        ];
    }

    public function init(): void
    {
        $this->addColumns();
        $this->addFlags();
    }
}
