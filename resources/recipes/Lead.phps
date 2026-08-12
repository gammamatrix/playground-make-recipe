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

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasOne = [
        'campaign' => [
            'comment' => 'The campaign of the %1$s.',
            'accessor' => 'campaign',
            'related' => 'Campaign',
            'foreignKey' => 'id',
            'localKey' => 'campaign_id',
        ],
        'goal' => [
            'comment' => 'The goal of the %1$s.',
            'accessor' => 'goal',
            'related' => 'Goal',
            'foreignKey' => 'id',
            'localKey' => 'goal_id',
        ],
        'lead' => [
            'comment' => 'The lead of the %1$s.',
            'accessor' => 'lead',
            'related' => 'Lead',
            'foreignKey' => 'id',
            'localKey' => 'lead_id',
        ],
        'opportunity' => [
            'comment' => 'The opportunity of the %1$s.',
            'accessor' => 'opportunity',
            'related' => 'Opportunity',
            'foreignKey' => 'id',
            'localKey' => 'opportunity_id',
        ],
        'plan' => [
            'comment' => 'The plan of the %1$s.',
            'accessor' => 'plan',
            'related' => 'Plan',
            'foreignKey' => 'id',
            'localKey' => 'plan_id',
        ],
        'region' => [
            'comment' => 'The region of the %1$s.',
            'accessor' => 'region',
            'related' => 'Region',
            'foreignKey' => 'id',
            'localKey' => 'region_id',
        ],
        'report' => [
            'comment' => 'The report of the %1$s.',
            'accessor' => 'report',
            'related' => 'Report',
            'foreignKey' => 'id',
            'localKey' => 'report_id',
        ],
        'source' => [
            'comment' => 'The source of the %1$s.',
            'accessor' => 'source',
            'related' => 'Source',
            'foreignKey' => 'id',
            'localKey' => 'source_id',
        ],
        'task' => [
            'comment' => 'The task of the %1$s.',
            'accessor' => 'task',
            'related' => 'Task',
            'foreignKey' => 'id',
            'localKey' => 'task_id',
        ],
        'team' => [
            'comment' => 'The team of the %1$s.',
            'accessor' => 'team',
            'related' => 'Team',
            'foreignKey' => 'id',
            'localKey' => 'team_id',
        ],
        'teammate' => [
            'comment' => 'The teammate of the %1$s.',
            'accessor' => 'teammate',
            'related' => 'Teammate',
            'foreignKey' => 'id',
            'localKey' => 'teammate_id',
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

        $this->columns['team_role'] = [
            'label' => 'Team role',
            'nullable' => true,
            'type' => 'string',
        ];

        $this->columns['currency'] = [
            'label' => 'Currency',
            'nullable' => true,
            'type' => 'string',
        ];

        $this->columns['amount'] = [
            'label' => 'Amount',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['bonus'] = [
            'label' => 'Bonus',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['bonus_rate'] = [
            'description' => sprintf(
                'The bonus rate of the %1$s. Percent value is stored as decimal: 99%% => 0.99',
                $this->name_lower
            ),
            'label' => 'Bonus rate',
            'precision' => 8,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['commission'] = [
            'label' => 'Commission',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['commission_rate'] = [
            'description' => sprintf(
                'The commission rate of the %1$s. Percent value is stored as decimal: 99%% => 0.99',
                $this->name_lower
            ),
            'label' => 'Commission rate',
            'precision' => 8,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['estimate'] = [
            'label' => 'Estimate',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['fees'] = [
            'label' => 'Fees',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['materials'] = [
            'label' => 'Materials',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['services'] = [
            'label' => 'Services',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['shipping'] = [
            'label' => 'Shipping',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['subtotal'] = [
            'label' => 'Subtotal',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['taxable'] = [
            'label' => 'Taxable',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['tax_rate'] = [
            'label' => 'Tax rate',
            'precision' => 8,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['taxes'] = [
            'label' => 'Taxes',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['total'] = [
            'label' => 'Total',
            'precision' => 19,
            'nullable' => true,
            'type' => 'decimal',
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
            'type' => 'boolean',
        ];

        $this->flags['sms'] = [
            'icon' => 'fa-solid fa-comment-sms',
            'default' => false,
            'label' => 'SMS',
            'type' => 'boolean',
        ];

        $this->flags['special'] = [
            'icon' => 'fa-solid fa-star text-success',
            'default' => false,
            'label' => 'Special',
            'index' => true,
            'nullable' => true,
            'type' => 'boolean',
        ];

        ksort($this->flags);
    }

    public function addJson(): void
    {
        $this->json['address'] = [
            'label' => 'Address',
            'default' => '{}',
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ];

        $this->json['contact'] = [
            'label' => 'Contact',
            'default' => '{}',
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
    }
}
