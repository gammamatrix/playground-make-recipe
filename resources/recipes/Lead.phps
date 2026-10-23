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
        'tagged_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_tagged',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'tag_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'lead_tags',
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
        'special' => [
            'type' => 'flag',
            'value' => true,
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

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasMany = [
        'campaigns' => [
            'comment' => 'The campaigns of the %1$s.',
            'accessor' => 'campaigns',
            'related' => 'Campaign',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'goals' => [
            'comment' => 'The goals of the %1$s.',
            'accessor' => 'goals',
            'related' => 'Goal',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'leads' => [
            'comment' => 'The leads of the %1$s.',
            'accessor' => 'leads',
            'related' => 'Lead',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'opportunities' => [
            'comment' => 'The opportunities of the %1$s.',
            'accessor' => 'opportunities',
            'related' => 'Opportunity',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'plans' => [
            'comment' => 'The plans of the %1$s.',
            'accessor' => 'plans',
            'related' => 'Plan',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'regions' => [
            'comment' => 'The regions of the %1$s.',
            'accessor' => 'regions',
            'related' => 'Region',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'reports' => [
            'comment' => 'The reports of the %1$s.',
            'accessor' => 'reports',
            'related' => 'Report',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'sources' => [
            'comment' => 'The sources of the %1$s.',
            'accessor' => 'sources',
            'related' => 'Source',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'tasks' => [
            'comment' => 'The tasks of the %1$s.',
            'accessor' => 'tasks',
            'related' => 'Task',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'teams' => [
            'comment' => 'The teams of the %1$s.',
            'accessor' => 'teams',
            'related' => 'Team',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'teammates' => [
            'comment' => 'The teammates of the %1$s.',
            'accessor' => 'teammates',
            'related' => 'Teammate',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    protected array $hasManyThrough = [
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
            'firstKey' => 'task_id',
            'secondKey' => 'id',
            'localKey' => 'id',
            'secondLocalKey' => 'tag_id',
            'through' => 'Tagged',
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
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['bonus'] = [
            'label' => 'Bonus',
            'precision' => 19,
            'scale' => 4,
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
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['commission'] = [
            'label' => 'Commission',
            'precision' => 19,
            'scale' => 4,
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
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['estimate'] = [
            'label' => 'Estimate',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['fees'] = [
            'label' => 'Fees',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['materials'] = [
            'label' => 'Materials',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['services'] = [
            'label' => 'Services',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['shipping'] = [
            'label' => 'Shipping',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['subtotal'] = [
            'label' => 'Subtotal',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['taxable'] = [
            'label' => 'Taxable',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['tax_rate'] = [
            'label' => 'Tax rate',
            'precision' => 8,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['taxes'] = [
            'label' => 'Taxes',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['total'] = [
            'label' => 'Total',
            'precision' => 19,
            'scale' => 4,
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
            'index' => true,
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
        /**
         * @var array<string, array<string, mixed>> $allIds
         */
        $allIds = \Illuminate\Support\Arr::except($this->allIds, ['parent_id', 'matrix_id']);

        if ($this->type === 'playground-model-tagged') { 
            $this->circletHasOne['campaign']['comment'] = 'The tagged campaign.';
            $this->circletHasOne['goal']['comment'] = 'The tagged goal.';
            $this->circletHasOne['lead']['comment'] = 'The tagged lead.';
            $this->circletHasOne['opportunity']['comment'] = 'The tagged opportunity.';
            $this->circletHasOne['plan']['comment'] = 'The tagged plan.';
            $this->circletHasOne['region']['comment'] = 'The tagged region.';
            $this->circletHasOne['report']['comment'] = 'The tagged report.';
            $this->circletHasOne['source']['comment'] = 'The tagged source.';
            $this->circletHasOne['task']['comment'] = 'The tagged task.';
            $this->circletHasOne['team']['comment'] = 'The tagged team.';
            $this->circletHasOne['teammate']['comment'] = 'The tagged teammate.';
            $this->allIds = $allIds;
            $this->handleTagged();
            $this->handleCircletHasOne();
            return;
        }

        /**
         * @var array<string, array<string, mixed>> $onlyIds
         */
        $onlyIds = \Illuminate\Support\Arr::only($this->allIds, ['parent_id', 'matrix_id']);

        if ($this->name === 'Tag') {
            $this->allIds = $onlyIds;
            $this->circletHasOne = [];
            $this->circletHasMany = [];
            $this->hasManyThrough = [];
            $this->handleCircletHasOne();
            return;
        }

        $this->hasManyThrough['tags']['firstKey'] = $this->table_id;
        $this->hasManyThrough['tags']['comment'] = sprintf('The tags of the %1$s.', $this->name_lower());

        unset($this->allIds['tag_id']);
        unset($this->allIds['tagged_id']);
        unset($this->circletHasOne['tag']);
        unset($this->circletHasMany['tags']);

        $this->addColumns();
        $this->addDates();
        $this->addFlags();
        $this->addJson();
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
    }
}
