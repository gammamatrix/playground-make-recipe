<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Workout
 */
class Workout extends Playground
{

    protected array $ids = [
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
    ];

    public function addColumns(): void
    {
        $this->columns['repetitions'] = [
            'label' => 'Repetitions',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];
    }

    public function init(): void
    {
        $this->addColumns();
    }
}
