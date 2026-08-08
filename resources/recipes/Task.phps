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
        'task_list_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'task_task_lists',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'task_log_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'task_task_logs',
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
        'task' => [
            'comment' => 'The task of the %1$s.',
            'accessor' => 'task',
            'related' => 'Task',
            'foreignKey' => 'id',
            'localKey' => 'task_id',
        ],
        'task_list' => [
            'comment' => 'The task list of the %1$s.',
            'accessor' => 'taskList',
            'related' => 'TaskList',
            'foreignKey' => 'id',
            'localKey' => 'task_list_id',
        ],
        'task_log' => [
            'comment' => 'The task log of the %1$s.',
            'accessor' => 'taskLog',
            'related' => 'TaskLog',
            'foreignKey' => 'id',
            'localKey' => 'task_log_id',
        ],
    ];

    public function addColumns(): void
    {
        $this->columns['duration'] = [
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];
    }

    public function addDates(): void
    {
        $this->dates['due_at'] = [
            'label' => 'Due At',
            'nullable' => true,
        ];

        ksort($this->dates);
    }

    public function addFlags(): void
    {
        $this->flags['skip'] = [
            'icon' => 'fa-solid fa-forward-step text-warning',
            'default' => false,
            'label' => 'Skip',
            'type' => 'boolean',
        ];

        ksort($this->flags);
    }

    public function addJson(): void
    {
        $this->json['recur'] = [
            'description' => 'Provides a JSON object for CRON style recurring rules.',
            'label' => 'Recur',
            'default' => null,
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
