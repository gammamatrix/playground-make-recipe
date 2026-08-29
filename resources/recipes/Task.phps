<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace App\Recipes;

use Illuminate\Support\Arr;
use Playground\Make\Model\Recipe\Playground;

/**
 * \App\Recipes\Task
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
        'taskList' => [
            'comment' => 'The task list of the %1$s.',
            'accessor' => 'taskList',
            'related' => 'TaskList',
            'foreignKey' => 'id',
            'localKey' => 'task_list_id',
        ],
        'taskLog' => [
            'comment' => 'The task log of the %1$s.',
            'accessor' => 'taskLog',
            'related' => 'TaskLog',
            'foreignKey' => 'id',
            'localKey' => 'task_log_id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasMany = [
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
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
        'taskLists' => [
            'comment' => 'The task lists of the %1$s.',
            'accessor' => 'taskLists',
            'related' => 'TaskList',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
        'taskLogs' => [
            'comment' => 'The task logs of the %1$s.',
            'accessor' => 'taskLogs',
            'related' => 'TaskLog',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    public function addColumns(): void
    {
        $this->columns['duration'] = [
            'description' => 'The duration of the task in seconds.',
            'label' => 'Duration',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];
    }

    public function addDates(): void
    {
        $this->dates['due_at'] = [
            'label' => 'Due at',
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
            'comment' => 'Provides a JSON object for CRON style recurring rules.',
            'label' => 'Recur',
            'default' => null,
            'nullable' => true,
            'type' => 'JSON_OBJECT',
        ];
    }

    public function init(): void
    {
        if ($this->name === 'Tagged') {
            $this->columns = Arr::only($this->columns, ['created_at']);
            $this->userIds = Arr::only($this->userIds, ['owned_by_id']);
            $this->ids = [];
            $this->json = [];
            $this->dates = [];
            $this->circletHasMany = [];
            $this->circletHasOne = [];
            $this->allIds = Arr::except($this->allIds, ['parent_id', 'matrix_id']);
            $this->matrix = [];
            $this->flags = [];
            $this->permissions = [];
            $this->status = [];
            $this->ui = [];
            $this->unique = [];
            $this->timestamp_deleted = '';
            $this->timestamp_updated = '';

            return;
        }
        $this->addColumns();
        $this->addDates();
        $this->addFlags();
        $this->addJson();
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
    }
}
