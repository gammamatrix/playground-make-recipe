<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Task
 */
class Task extends Playground
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
        'task_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'task_tasks',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
    ];

    public function init(): void
    {

    }
}
