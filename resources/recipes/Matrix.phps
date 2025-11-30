<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Models;

/**
 * \Playground\Make\Models\Recipe\Matrix
 */
class Matrix extends Playground
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
            'nullable' => true,
            'index' => true,
            'trait' => 'WithParent',
            'type' => 'uuid',
        ],
        'backlog_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_backlogs',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'board_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_boards',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'epic_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_epic',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'flow_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_flows',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'matrix_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_matrices',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'milestone_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_milestones',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'note_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_notes',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'project_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_projects',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'release_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_releases',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'roadmap_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_roadmaps',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'source_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_sources',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'sprint_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_sprints',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'tag_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_tags',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'team_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_teams',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'ticket_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_tickets',
            ],
            'nullable' => true,
            'index' => true,
            'type' => 'uuid',
        ],
        'version_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'matrix_versions',
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
