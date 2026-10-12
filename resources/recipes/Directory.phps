<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Directory
 */
class Directory extends Playground
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
        'location_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'directory_locations',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'contact_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'directory_contact',
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

    protected array $hasMany = [
        'revisions' => [
            'comment' => 'The revisions of the model.',
            'accessor' => 'revisions',
            'related' => '',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    protected array $hasOne = [
        'location' => [
            'comment' => 'The location of the revision.',
            'accessor' => 'location',
            'related' => 'Location',
            'foreignKey' => 'id',
            'localKey' => 'location_id',
        ],
        'contact' => [
            'comment' => 'The contact of the revision.',
            'accessor' => 'contact',
            'related' => 'Contact',
            'foreignKey' => 'id',
            'localKey' => 'contact_id',
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
        $this->flags['sitemap'] = [
            'icon' => 'fa-solid fa-sitemap text-success',
            'default' => false,
            'label' => 'Sitemap',
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
        $this->handleHasOne();
        $this->withRevisions();
    }

    public function withRevisions(): void
    {
        $this->status['revision'] = [
            'type' => 'bigInteger',
            'default' => false,
            'unsigned' => true,
            'readOnly' => true,
            'icon' => '',
        ];

        if (! in_array($this->name(), [
            'Location',
            'Contact',
        ])) {
            unset($this->hasMany['revisions']);
        }

        if (in_array($this->name(), [
            'Location',
        ])) {
            $this->hasMany['revisions']['comment'] = 'The revisions of the location.';
            $this->hasMany['revisions']['related'] = 'LocationRevision';
            $this->hasMany['revisions']['foreignKey'] = 'location_id';
        }

        if (! in_array($this->name(), [
            'LocationRevision',
        ])) {
            unset($this->ids['location_id']);
            unset($this->hasOne['location']);
        }

        if (in_array($this->name(), [
            'Contact',
        ])) {
            $this->hasMany['revisions']['comment'] = 'The revisions of the contact.';
            $this->hasMany['revisions']['related'] = 'ContactRevision';
            $this->hasMany['revisions']['foreignKey'] = 'contact_id';
        }

        if (! in_array($this->name(), [
            'ContactRevision',
        ])) {
            unset($this->ids['contact_id']);
            unset($this->hasOne['contact']);
        }
    }
}
