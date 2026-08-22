<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace App\Recipes;

use Playground\Make\Model\Recipe\Playground;

/**
 * \App\Recipes\Workout
 */
class Workout extends Playground
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
        'exercise_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_exercises',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'routine_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_routines',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'workout_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_workouts',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'schedule_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_schedules',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'team_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_teams',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'teammate_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_teammates',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'equipment_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_equipments',
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
        'exercise' => [
            'comment' => 'The exercise of the %1$s.',
            'accessor' => 'exercise',
            'related' => 'Exercise',
            'foreignKey' => 'id',
            'localKey' => 'exercise_id',
        ],
        'routine' => [
            'comment' => 'The routine of the %1$s.',
            'accessor' => 'routine',
            'related' => 'Routine',
            'foreignKey' => 'id',
            'localKey' => 'routine_id',
        ],
        'workout' => [
            'comment' => 'The workout of the %1$s.',
            'accessor' => 'workout',
            'related' => 'Workout',
            'foreignKey' => 'id',
            'localKey' => 'workout_id',
        ],
        'schedule' => [
            'comment' => 'The schedule of the %1$s.',
            'accessor' => 'schedule',
            'related' => 'Schedule',
            'foreignKey' => 'id',
            'localKey' => 'schedule_id',
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
        'equipment' => [
            'comment' => 'The equipment of the %1$s.',
            'accessor' => 'equipment',
            'related' => 'Equipment',
            'foreignKey' => 'id',
            'localKey' => 'equipment_id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasMany = [
        'exercises' => [
            'comment' => 'The exercises of the %1$s.',
            'accessor' => 'exercises',
            'related' => 'Exercise',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'routines' => [
            'comment' => 'The routines of the %1$s.',
            'accessor' => 'routines',
            'related' => 'Routine',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'workouts' => [
            'comment' => 'The workouts of the %1$s.',
            'accessor' => 'workouts',
            'related' => 'Workout',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'schedules' => [
            'comment' => 'The schedules of the %1$s.',
            'accessor' => 'schedules',
            'related' => 'Schedule',
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
        'equipments' => [
            'comment' => 'The equipments of the %1$s.',
            'accessor' => 'equipments',
            'related' => 'Equipment',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    public function addColumns(): void
    {
        $this->columns['repetitions'] = [
            'label' => 'Repetitions',
            'nullable' => true,
            'type' => 'string',
        ];

        $this->columns['weight'] = [
            'label' => 'Weight',
            'precision' => 19,
            'scale' => 4,
            'nullable' => true,
            'type' => 'decimal',
        ];

        $this->columns['duration'] = [
            'label' => 'Duration',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];
    }

    public function addFlags(): void
    {
        $this->flags['skip'] = [
            'icon' => '',
            'default' => false,
            'label' => 'Skip',
            'type' => 'boolean',
        ];

        $this->flags['partial'] = [
            'icon' => '',
            'default' => false,
            'label' => 'Partial',
            'type' => 'boolean',
        ];

        $this->flags['resumed'] = [
            'icon' => '',
            'default' => false,
            'label' => 'Resumed',
            'type' => 'boolean',
        ];

        ksort($this->flags);
    }

    public function init(): void
    {
        $this->addColumns();
        $this->addFlags();
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
    }
}
