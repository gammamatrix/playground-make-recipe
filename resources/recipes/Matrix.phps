<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Matrix
 */
class Matrix extends Playground
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
        'backlog_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_backlogs',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'board_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_boards',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'epic_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_epics',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'flow_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_flows',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'milestone_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_milestones',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'note_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_notes',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'project_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_projects',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'release_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_releases',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'roadmap_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_roadmaps',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'source_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_sources',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'sprint_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_sprints',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'tag_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_tags',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'team_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_teams',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'ticket_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_tickets',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'version_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_versions',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'tagged_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_tagged',
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

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasOne = [
        'backlog' => [
            'comment' => 'The backlog of the %1$s.',
            'accessor' => 'backlog',
            'related' => 'Backlog',
            'foreignKey' => 'id',
            'localKey' => 'backlog_id',
        ],
        'board' => [
            'comment' => 'The board of the %1$s.',
            'accessor' => 'board',
            'related' => 'Board',
            'foreignKey' => 'id',
            'localKey' => 'board_id',
        ],
        'epic' => [
            'comment' => 'The epic of the %1$s.',
            'accessor' => 'epic',
            'related' => 'Epic',
            'foreignKey' => 'id',
            'localKey' => 'epic_id',
        ],
        'flow' => [
            'comment' => 'The flow of the %1$s.',
            'accessor' => 'flow',
            'related' => 'Flow',
            'foreignKey' => 'id',
            'localKey' => 'flow_id',
        ],
        'matrix' => [
            'comment' => 'The matrix of the %1$s.',
            'accessor' => 'matrix',
            'related' => 'Matrix',
            'foreignKey' => 'id',
            'localKey' => 'matrix_id',
        ],
        'milestone' => [
            'comment' => 'The milestone of the %1$s.',
            'accessor' => 'milestone',
            'related' => 'Milestone',
            'foreignKey' => 'id',
            'localKey' => 'milestone_id',
        ],
        'note' => [
            'comment' => 'The note of the %1$s.',
            'accessor' => 'note',
            'related' => 'Note',
            'foreignKey' => 'id',
            'localKey' => 'note_id',
        ],
        'project' => [
            'comment' => 'The project of the %1$s.',
            'accessor' => 'project',
            'related' => 'Project',
            'foreignKey' => 'id',
            'localKey' => 'project_id',
        ],
        'release' => [
            'comment' => 'The release of the %1$s.',
            'accessor' => 'release',
            'related' => 'Release',
            'foreignKey' => 'id',
            'localKey' => 'release_id',
        ],
        'roadmap' => [
            'comment' => 'The roadmap of the %1$s.',
            'accessor' => 'roadmap',
            'related' => 'Roadmap',
            'foreignKey' => 'id',
            'localKey' => 'roadmap_id',
        ],
        'source' => [
            'comment' => 'The source of the %1$s.',
            'accessor' => 'source',
            'related' => 'Source',
            'foreignKey' => 'id',
            'localKey' => 'source_id',
        ],
        'sprint' => [
            'comment' => 'The sprint of the %1$s.',
            'accessor' => 'sprint',
            'related' => 'Sprint',
            'foreignKey' => 'id',
            'localKey' => 'sprint_id',
        ],
        'tag' => [
            'comment' => 'The tag.',
            'accessor' => 'tag',
            'related' => 'Tag',
            'foreignKey' => 'id',
            'localKey' => 'tag_id',
        ],
        'team' => [
            'comment' => 'The team of the %1$s.',
            'accessor' => 'team',
            'related' => 'Team',
            'foreignKey' => 'id',
            'localKey' => 'team_id',
        ],
        'ticket' => [
            'comment' => 'The ticket of the %1$s.',
            'accessor' => 'ticket',
            'related' => 'Ticket',
            'foreignKey' => 'id',
            'localKey' => 'ticket_id',
        ],
        'version' => [
            'comment' => 'The version of the %1$s.',
            'accessor' => 'version',
            'related' => 'Version',
            'foreignKey' => 'id',
            'localKey' => 'version_id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasMany = [
        'backlogs' => [
            'comment' => 'The backlogs of the %1$s.',
            'accessor' => 'backlogs',
            'related' => 'Backlog',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'boards' => [
            'comment' => 'The boards of the %1$s.',
            'accessor' => 'boards',
            'related' => 'Board',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'epics' => [
            'comment' => 'The epics of the %1$s.',
            'accessor' => 'epics',
            'related' => 'Epic',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'flows' => [
            'comment' => 'The flows of the %1$s.',
            'accessor' => 'flows',
            'related' => 'Flow',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'matrices' => [
            'comment' => 'The matrices of the %1$s.',
            'accessor' => 'matrices',
            'related' => 'Matrix',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'milestones' => [
            'comment' => 'The milestones of the %1$s.',
            'accessor' => 'milestones',
            'related' => 'Milestone',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'notes' => [
            'comment' => 'The notes of the %1$s.',
            'accessor' => 'notes',
            'related' => 'Note',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'projects' => [
            'comment' => 'The projects of the %1$s.',
            'accessor' => 'projects',
            'related' => 'Project',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'releases' => [
            'comment' => 'The releases of the %1$s.',
            'accessor' => 'releases',
            'related' => 'Release',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'roadmaps' => [
            'comment' => 'The roadmaps of the %1$s.',
            'accessor' => 'roadmaps',
            'related' => 'Roadmap',
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
        'sprints' => [
            'comment' => 'The sprints of the %1$s.',
            'accessor' => 'sprints',
            'related' => 'Sprint',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
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
        'tickets' => [
            'comment' => 'The tickets of the %1$s.',
            'accessor' => 'tickets',
            'related' => 'Ticket',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'versions' => [
            'comment' => 'The versions of the %1$s.',
            'accessor' => 'versions',
            'related' => 'Version',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $hasManyThrough = [
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
            'firstKey' => '',
            'secondKey' => 'id',
            'localKey' => 'id',
            'secondLocalKey' => 'tag_id',
            'through' => 'Tagged',
        ],
    ];

    public function addIds(): void
    {
        if (in_array($this->name, [
            'Ticket',
        ])) {

            $this->allIds['completed_by_id'] = [
                'description' => '',
                'foreign' => [
                    'references' => 'id',
                    'on' => 'users',
                ],
                'index' => true,
                'nullable' => true,
                'type' => 'uuid',
            ];
            $this->circletHasOne['completedBy'] = [
                'comment' => 'The completed by user of the %1$s.',
                'accessor' => 'completedBy',
                'related' => '\Playground\Models\User',
                'foreignKey' => 'id',
                'localKey' => 'completed_by_id',
            ];

            $this->allIds['duplicate_id'] = [
                'description' => '',
                'foreign' => [
                    'references' => 'id',
                    'on' => 'matrix_tickets',
                ],
                'index' => true,
                'nullable' => true,
                'type' => 'uuid',
            ];
            $this->circletHasOne['duplicateBy'] = [
                'comment' => 'The duplicate of the %1$s.',
                'accessor' => 'duplicateBy',
                'related' => 'Ticket',
                'foreignKey' => 'id',
                'localKey' => 'duplicate_id',
            ];

            $this->allIds['fixed_by_id'] = [
                'description' => '',
                'foreign' => [
                    'references' => 'id',
                    'on' => 'users',
                ],
                'index' => true,
                'nullable' => true,
                'type' => 'uuid',
            ];
            $this->circletHasOne['fixedBy'] = [
                'comment' => 'The fixed by user of the %1$s.',
                'accessor' => 'fixedBy',
                'related' => '\Playground\Models\User',
                'foreignKey' => 'id',
                'localKey' => 'fixed_by_id',
            ];

            $this->allIds['reported_by_id'] = [
                'description' => '',
                'foreign' => [
                    'references' => 'id',
                    'on' => 'users',
                ],
                'index' => true,
                'nullable' => true,
                'type' => 'uuid',
            ];
            $this->circletHasOne['reportedBy'] = [
                'comment' => 'The reported by user of the %1$s.',
                'accessor' => 'reportedBy',
                'related' => '\Playground\Models\User',
                'foreignKey' => 'id',
                'localKey' => 'reported_by_id',
            ];

            $this->allIds['version_fixed_id'] = [
                'description' => '',
                'foreign' => [
                    'references' => 'id',
                    'on' => 'matrix_versions',
                ],
                'index' => true,
                'nullable' => true,
                'type' => 'uuid',
            ];
            $this->circletHasOne['versionFixed'] = [
                'comment' => 'The duplicate of the %1$s.',
                'accessor' => 'versionFixed',
                'related' => 'Version',
                'foreignKey' => 'id',
                'localKey' => 'version_fixed_id',
            ];

        }
    }

    public function unsetIds(): void
    {
        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Tag', 'Version', 'Tagged',
        ])) {
            unset($this->allIds['backlog_id']);
            unset($this->circletHasOne['backlog']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Tag', 'Version', 'Tagged',
        ])) {
            unset($this->allIds['board_id']);
            unset($this->circletHasOne['board']);
        }

        if (in_array($this->name, [
            'Epic', 'Flow', 'Matrix', 'Note', 'Source', 'Version',
        ])) {
            unset($this->allIds['epic_id']);
            unset($this->circletHasOne['epic']);
        }

        if (in_array($this->name, [
            'Matrix', 'Note', 'Source', 'Version',
        ])) {
            unset($this->allIds['flow_id']);
            unset($this->circletHasOne['flow']);
        }

        if (in_array($this->name, [
            'Backlog', 'Board', 'Epic', 'Flow', 'Matrix', 'Milestone', 'Note', 'Project', 'Release', 'Roadmap', 'Source', 'Sprint', 'Tag', 'Team', 'Ticket', 'Version', 'Tagged',
        ])) {
            unset($this->allIds['matrix_id']);
            unset($this->circletHasOne['matrix']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Milestone', 'Note', 'Source', 'Version',
        ])) {
            unset($this->allIds['milestone_id']);
            unset($this->circletHasOne['milestone']);
        }

        if (in_array($this->name, [
            'Matrix', 'Version',
        ])) {
            unset($this->allIds['note_id']);
            unset($this->circletHasOne['note']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source',
        ])) {
            unset($this->allIds['project_id']);
            unset($this->circletHasOne['project']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Release', 'Source', 'Version',
        ])) {
            unset($this->allIds['release_id']);
            unset($this->circletHasOne['release']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Version',
        ])) {
            unset($this->allIds['roadmap_id']);
            unset($this->circletHasOne['roadmap']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Version',
        ])) {
            unset($this->allIds['source_id']);
            unset($this->circletHasOne['source']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Version',
        ])) {
            unset($this->allIds['sprint_id']);
            unset($this->circletHasOne['sprint']);
        }



        if (in_array($this->name, [
            'Matrix', 'Note',
        ])) {
            unset($this->allIds['team_id']);
            unset($this->circletHasOne['team']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source',
        ])) {
            unset($this->allIds['ticket_id']);
            unset($this->circletHasOne['ticket']);
        }

        if (in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source',
        ])) {
            unset($this->allIds['version_id']);
            unset($this->circletHasOne['version']);
        }
    }

    public function addColumns(): void
    {
        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['handler'] = [
                'label' => 'Handler',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Project', 'Ticket',
        ])) {
            $this->columns['key'] = [
                'label' => 'Key',
                'index' => true,
                'nullable' => true,
                'size' => 32,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['code'] = [
                'label' => 'Code',
                'index' => true,
                'nullable' => true,
                'unsigned' => true,
                'type' => 'bigInteger',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['key_code_hash'] = [
                'label' => 'Key code hash',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['priority'] = [
                'label' => 'Priority',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['severity'] = [
                'label' => 'Severity',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['resolution'] = [
                'label' => 'Resolution',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['step'] = [
                'label' => 'Step',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['state'] = [
                'label' => 'State',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['workflow_type'] = [
                'label' => 'Workflow type',
                'nullable' => true,
                'type' => 'string',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['points'] = [
                'default' => '0',
                'label' => 'Points',
                'type' => 'bigInteger',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['actual'] = [
                'label' => 'Actual',
                'nullable' => true,
                'type' => 'mediumText',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['expected'] = [
                'label' => 'Expected',
                'nullable' => true,
                'type' => 'mediumText',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['story'] = [
                'label' => 'Story',
                'nullable' => true,
                'type' => 'mediumText',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['steps'] = [
                'label' => 'Steps',
                'nullable' => true,
                'type' => 'mediumText',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['criteria'] = [
                'label' => 'Criteria',
                'nullable' => true,
                'type' => 'mediumText',
            ];
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->columns['reproducibility'] = [
                'label' => 'Reproducibility',
                'precision' => 8,
                'scale' => 2,
                'nullable' => true,
                'type' => 'decimal',
            ];
        }

        if (in_array($this->name, [
            'Project',
        ])) {
            $this->columns['code_name'] = [
                'label' => 'Code name',
                'index' => true,
                'nullable' => true,
                'size' => 128,
                'type' => 'string',
            ];
        }
    }

    public function addDates(): void
    {
        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['canceled_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['closed_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['embargo_at']);
        }

        if (in_array($this->name, [
            'Ticket',
        ])) {
            $this->dates['fixed_at'] = [
                'label' => 'Fixed at',
                'nullable' => true,
            ];
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['planned_end_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['planned_start_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['postponed_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['published_at']);
        }

        if (in_array($this->name, [
            'Backlog', 'Board', 'Epic', 'Flow', 'Matrix', 'Milestone', 'Note', 'Project', 'Release', 'Roadmap', 'Source', 'Sprint', 'Tag', 'Team', 'Version', 'Tagged',
        ])) {
            unset($this->dates['released_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['resolved_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['resumed_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['suspended_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['timer_end_at']);
        }

        if (in_array($this->name, [
            'Note',
        ])) {
            unset($this->dates['timer_start_at']);
        }

        ksort($this->dates);
    }

    public function addFlags(): void
    {
        if (in_array($this->name, [
            'Backlog', 'Board', 'Epic', 'Flow', 'Matrix', 'Milestone', 'Note', 'Release', 'Roadmap', 'Source', 'Sprint', 'Tag', 'Team', 'Version', 'Tagged',
        ])) {
            unset($this->flags['duplicate']);
        }

        if (in_array($this->name, [
            'Backlog', 'Board', 'Epic', 'Flow', 'Matrix', 'Milestone', 'Note', 'Release', 'Roadmap', 'Source', 'Sprint', 'Tag', 'Team', 'Tagged',
        ])) {
            unset($this->flags['fixed']);
        }

        if (in_array($this->name, [
            'Backlog', 'Board', 'Epic', 'Flow', 'Matrix', 'Milestone', 'Note', 'Release', 'Roadmap', 'Source', 'Sprint', 'Tag', 'Team', 'Tagged',
        ])) {
            unset($this->flags['resolved']);
        }

        $this->flags['featured'] = [
            'icon' => 'fa-solid fa-star text-primary',
            'default' => false,
            'label' => 'Featured',
            'type' => 'boolean',
        ];

        $this->flags['special'] = [
            'icon' => 'fa-solid fa-star text-success',
            'default' => false,
            'label' => 'Special',
            'type' => 'boolean',
        ];

        ksort($this->flags);
    }

    public function addJson(): void
    {
        if (! in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Tag', 'Version', 'Tagged',
        ])) {
            $this->json['backlog'] = [
                'label' => 'Backlog',
                'default' => null,
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }

        if (! in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Tag', 'Version', 'Tagged',
        ])) {
            $this->json['board'] = [
                'label' => 'Board',
                'default' => null,
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }

        if (! in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Tag', 'Version', 'Tagged',
        ])) {
            $this->json['flow'] = [
                'label' => 'Flow',
                'default' => null,
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }

        if (! in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Source', 'Tag', 'Version', 'Tagged',
        ])) {
            $this->json['history'] = [
                'label' => 'History',
                'default' => null,
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }

        if (! in_array($this->name, [
            'Flow', 'Matrix', 'Note', 'Roadmap', 'Source', 'Tag', 'Version', 'Tagged',
        ])) {
            $this->json['roadmap'] = [
                'label' => 'Roadmap',
                'default' => null,
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }
    }

    public function init(): void
    {
        /**
         * @var array<string, array<string, mixed>> $allIds
         */
        $allIds = \Illuminate\Support\Arr::except($this->allIds, ['parent_id', 'matrix_id']);

        if ($this->type === 'playground-model-tagged') {
            $this->circletHasOne['backlog']['comment'] = 'The tagged backlog.';
            $this->circletHasOne['board']['comment'] = 'The tagged board.';
            $this->circletHasOne['epic']['comment'] = 'The tagged epic.';
            $this->circletHasOne['flow']['comment'] = 'The tagged flow.';
            $this->circletHasOne['matrix']['comment'] = 'The tagged matrix.';
            $this->circletHasOne['milestone']['comment'] = 'The tagged milestone.';
            $this->circletHasOne['note']['comment'] = 'The tagged note.';
            $this->circletHasOne['project']['comment'] = 'The tagged project.';
            $this->circletHasOne['release']['comment'] = 'The tagged release.';
            $this->circletHasOne['roadmap']['comment'] = 'The tagged roadmap.';
            $this->circletHasOne['source']['comment'] = 'The tagged source.';
            $this->circletHasOne['sprint']['comment'] = 'The tagged sprint.';
            $this->circletHasOne['tag']['comment'] = 'The tagged tag.';
            $this->circletHasOne['team']['comment'] = 'The tagged team.';
            $this->circletHasOne['ticket']['comment'] = 'The tagged ticket.';
            $this->circletHasOne['version']['comment'] = 'The tagged version.';
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

        $this->addIds();
        $this->unsetIds();
        $this->addColumns();
        $this->addDates();
        $this->addFlags();
        $this->addJson();
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
    }
}
