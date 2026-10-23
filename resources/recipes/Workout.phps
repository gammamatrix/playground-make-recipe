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
        'tag_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_tags',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'tagged_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'workout_tagged',
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
        'skipped' => [
            'type' => 'flag',
            'value' => true,
        ],
        'resumed' => [
            'type' => 'flag',
            'value' => true,
        ],
        'partial' => [
            'type' => 'flag',
            'value' => true,
        ],
        'locked' => [
            'type' => 'flag',
            'value' => true,
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
        'tag' => [
            'comment' => 'The tag.',
            'accessor' => 'tag',
            'related' => 'Tag',
            'foreignKey' => 'id',
            'localKey' => 'tag_id',
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
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
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

    public function addColumns(): void
    {
        $this->columns['repetitions'] = [
            'label' => 'Repetitions',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
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

    public function addDates(): void
    {
        $this->dates['skipped_at'] = [
            'label' => 'Skipped at',
        ];

        ksort($this->dates);
    }

    public function addFlags(): void
    {
        $this->flags['skipped'] = [
            'icon' => '',
            'default' => false,
            'label' => 'Skipped',
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
        /**
         * @var array<string, array<string, mixed>> $allIds
         */
        $allIds = \Illuminate\Support\Arr::except($this->allIds, ['parent_id', 'matrix_id']);

        if ($this->type === 'playground-model-tagged') { 
            $this->circletHasOne['exercise']['comment'] = 'The tagged exercise.';
            $this->circletHasOne['routine']['comment'] = 'The tagged routine.';
            $this->circletHasOne['workout']['comment'] = 'The tagged workout.';
            $this->circletHasOne['schedule']['comment'] = 'The tagged schedule.';
            $this->circletHasOne['team']['comment'] = 'The tagged team.';
            $this->circletHasOne['teammate']['comment'] = 'The tagged teammate.';
            $this->circletHasOne['equipment']['comment'] = 'The tagged equipment.';
            $this->circletHasOne['tag']['comment'] = 'The tagged tag.';
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
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
    }
}
