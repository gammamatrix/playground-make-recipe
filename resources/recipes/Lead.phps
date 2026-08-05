<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Lead
 */
class Lead extends Playground
{
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
        'special' => [
            'type' => 'flag',
            'value' => true,
        ],
    ];

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
        'campaign_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_campaigns',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'goal_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_goals',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'lead_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_leads',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'opportunity_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_opportunities',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'plan_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_plans',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'region_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_regions',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'report_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_reports',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'source_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_sources',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'task_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_tasks',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'team_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_teams',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'teammate_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_teammates',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
    ];

    protected array $json = [
        'address' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'assets' => [
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ],
        'contact' => [
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

        $this->columns['team_role'] = [
            'nullable' => true,
            'type' => 'string',
        ];

        $this->columns['currency'] = [
            'nullable' => true,
            'type' => 'string',
        ];

        $this->columns['amount'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['bonus'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['bonus_rate'] = [
            'description' => sprintf(
                'The bonus rate of the %1$s. Percent value is stored as decimal: 99%% => 0.99',
                $this->name_lower
            ),
            'precision' => 8,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['commission'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['commission_rate'] = [
            'description' => sprintf(
                'The commission rate of the %1$s. Percent value is stored as decimal: 99%% => 0.99',
                $this->name_lower
            ),
            'precision' => 8,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['estimate'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['fees'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['materials'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['services'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['shipping'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['subtotal'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['taxable'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['tax_rate'] = [
            'precision' => 8,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['taxes'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['total'] = [
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];
    }

    public function addDates(): void
    {
        $this->dates['fixed_at'] = [
            'nullable' => true,
        ];

        ksort($this->dates);
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

        $this->flags['special'] = [
            'icon' => 'fa-solid fa-star text-success',
            'default' => false,
            'index' => true,
            'nullable' => true,
            'type' => 'boolean',
        ];

        ksort($this->flags);
    }

    public function init(): void
    {
        $this->addColumns();
        $this->addDates();
        $this->addFlags();
        $this->handleCircletHasOne();
    }
}
