<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

use Illuminate\Support\Str;

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
            'default' => '[]',
            'readOnly' => true,
            'nullable' => true,
            'type' => 'JSON_ARRAY',
            'comment' => 'Array of note objects',
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

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $ids = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $allIds = [
        'parent_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => null,
            ],
            'trait' => 'WithParent',
        ],
        'matrix_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_matrices',
            ],
        ],
        'campaign_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_campaigns',
            ],
        ],
        'goal_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_goals',
            ],
        ],
        'lead_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_leads',
            ],
        ],
        'opportunity_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_opportunities',
            ],
        ],
        'plan_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_plans',
            ],
        ],
        'region_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_regions',
            ],
        ],
        'report_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_reports',
            ],
        ],
        'source_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_sources',
            ],
        ],
        'task_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_tasks',
            ],
        ],
        'team_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_teams',
            ],
        ],
        'teammate_id' => [
            'type' => 'uuid',
            'nullable' => true,
            'index' => true,
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_teammates',
            ],
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasOne = [];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $allHasOne = [
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

    public function addDates(): void
    {
        $this->dates['fixed_at'] = [
            'nullable' => true,
            'index' => false,
        ];
        ksort($this->dates);
    }

    public function addColumns(): void
    {
        $this->columns['email'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->columns['phone'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->columns['team_role'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        // Finances

        $this->columns['currency'] = [
            'type' => 'string',
            'nullable' => true,
        ];

        $this->columns['amount'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['bonus'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['bonus_rate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 8,
            'scale' => 4,
            'description' => sprintf(
                'The bonus rate of the %1$s. Percent value is stored as decimal: 99%% => 0.99',
                $this->name_lower
            ),
        ];

        $this->columns['commission'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['commission_rate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 8,
            'scale' => 4,
            'description' => sprintf(
                'The commission rate of the %1$s. Percent value is stored as decimal: 99%% => 0.99',
                $this->name_lower
            ),
        ];

        $this->columns['estimate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['fees'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['materials'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['services'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['shipping'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['subtotal'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['taxable'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['tax_rate'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 8,
            'scale' => 4,
        ];

        $this->columns['taxes'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];

        $this->columns['total'] = [
            'type' => 'decimal',
            'nullable' => true,
            'precision' => 19,
            'scale' => 4,
        ];
    }

    public function addFlags(): void
    {
        $this->flags['featured'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-star text-warning',
        ];

        $this->flags['sms'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-comment-sms',
        ];

        $this->flags['special'] = [
            'type' => 'boolean',
            'default' => false,
            'icon' => 'fa-solid fa-star text-success',
        ];

        ksort($this->flags);
    }

    public function init(): void
    {
        $this->addColumns();
        $this->addDates();
        $this->addFlags();
        $this->handleHasOne();
    }
}
