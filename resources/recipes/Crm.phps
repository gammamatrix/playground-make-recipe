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
        'tagged_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'crm_tagged',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'tag_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'crm_tags',
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
        'featured' => [
            'type' => 'flag',
            'value' => true,
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasOne = [
        'client' => [
            'comment' => 'The client of the %1$s.',
            'accessor' => 'client',
            'related' => 'Client',
            'foreignKey' => 'id',
            'localKey' => 'client_id',
        ],
        'contact' => [
            'comment' => 'The contact of the %1$s.',
            'accessor' => 'contact',
            'related' => 'Contact',
            'foreignKey' => 'id',
            'localKey' => 'contact_id',
        ],
        'location' => [
            'comment' => 'The location of the %1$s.',
            'accessor' => 'location',
            'related' => 'Location',
            'foreignKey' => 'id',
            'localKey' => 'location_id',
        ],
        'organization' => [
            'comment' => 'The organization of the %1$s.',
            'accessor' => 'organization',
            'related' => 'Organization',
            'foreignKey' => 'id',
            'localKey' => 'organization_id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasMany = [
        'clients' => [
            'comment' => 'The clients of the %1$s.',
            'accessor' => 'clients',
            'related' => 'Client',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'contacts' => [
            'comment' => 'The contacts of the %1$s.',
            'accessor' => 'contacts',
            'related' => 'Contact',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'locations' => [
            'comment' => 'The locations of the %1$s.',
            'accessor' => 'locations',
            'related' => 'Location',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'organizations' => [
            'comment' => 'The organizations of the %1$s.',
            'accessor' => 'organizations',
            'related' => 'Organization',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    public function addColumns(): void
    {
        $this->columns['email'] = [
            'label' => 'Email',
            'nullable' => true,
            'type' => 'string',
        ];

        $this->columns['phone'] = [
            'label' => 'Phone',
            'nullable' => true,
            'type' => 'string',
        ];
    }

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
        $this->flags['featured'] = [
            'icon' => 'fa-solid fa-star text-primary',
            'default' => false,
            'label' => 'Featured',
            'index' => true,
            'type' => 'boolean',
        ];

        $this->flags['sms'] = [
            'icon' => 'fa-solid fa-comment-sms',
            'default' => false,
            'label' => 'SMS',
            'type' => 'boolean',
        ];

        ksort($this->flags);
    }

    public function addJson(): void
    {
        $this->json['address'] = [
            'label' => 'Address',
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ];

        $this->json['contact'] = [
            'label' => 'Contact',
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ];
    }

    public function init(): void
    {
        $this->addColumns();
        $this->addDates();
        $this->addFlags();
        $this->addJson();
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
    }
}
