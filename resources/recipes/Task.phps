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
    protected array $factoryStates = [
        'active' => [
            'type' => 'flag',
            'value' => true,
        ],
        'locked' => [
            'type' => 'flag',
            'value' => true,
        ],
        'skip' => [
            'type' => 'flag',
            'value' => true,
        ],
    ];

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
    protected array $hasManyThrough = [
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
            'through' => 'Tagged',
            'firstKey' => 'task_id',
            'secondKey' => 'id',
            'localKey' => 'id',
            'secondLocalKey' => 'tag_id',
        ],
    ];

    /**
     * @var array<string, array<string, mixed>>
     */
    protected array $circletHasMany = [
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

        $this->columns['day_of_week'] = [
            'description' => 'Bitwise day of the week: 1 => Sunday, 2 => Monday - 3 => Sunday and Monday',
            'label' => 'Day of Week',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];

        $this->columns['day_of_month'] = [
            'description' => 'Bitwise day of the month: 1 => 1st, 2 => 2nd - 3 => 1st and 2nd',
            'label' => 'Day of Month',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];

        $this->columns['day_of_quarter'] = [
            'description' => 'Contains a single day of the quarter: 1 - 92',
            'label' => 'Day of Quarter',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];

        $this->columns['day_of_year'] = [
            'description' => 'Contains a single day of the year: 1 - 366',
            'label' => 'Day of Year',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];

        $this->columns['week_of_month'] = [
            'description' => 'Contains a single week of the month: 1 - 6',
            'label' => 'Week of Month',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];

        $this->columns['week_of_quarter'] = [
            'description' => 'Contains a single week of the quarter: 1 - 13',
            'label' => 'Week of Year',
            'nullable' => true,
            'unsigned' => true,
            'type' => 'integer',
        ];

        $this->columns['week_of_year'] = [
            'description' => 'Contains a single week of the year: 1 - 52',
            'label' => 'Week of Year',
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
        if ($this->type === 'playground-model-tagged') {
            $this->columns = Arr::only($this->columns, ['created_at']);
            $this->dates = Arr::only($this->dates, ['created_at']);
            $this->userIds = Arr::only($this->userIds, ['created_by_id']);
            $this->allIds = [
                'tag_id' => [
                    'description' => '',
                    'foreign' => [
                        'references' => 'id',
                        'on' => 'task_tags',
                    ],
                    'index' => true,
                    'nullable' => true,
                    'type' => 'uuid',
                ],
                ...$this->allIds,
            ];
            $this->ids = [
                'tag_id' => [
                    'description' => '',
                    'foreign' => [
                        'references' => 'id',
                        'on' => 'task_tags',
                    ],
                    'index' => true,
                    'nullable' => true,
                    'type' => 'uuid',
                ],
            ];
            $this->json = [];
            $this->circletHasOne = [
                'creator' => [
                    'comment' => 'The creator.',
                    'accessor' => 'creator',
                    'related' => 'User',
                    'foreignKey' => 'id',
                    'localKey' => 'created_by_id',
                ],
                'tag' => [
                    'comment' => 'The tag.',
                    'accessor' => 'tag',
                    'related' => 'Tag',
                    'foreignKey' => 'id',
                    'localKey' => 'tag_id',
                ],
                ...$this->circletHasOne,
            ];
            $this->circletHasOne['task']['comment'] = 'The tagged task.';
            $this->circletHasOne['taskList']['comment'] = 'The tagged task list.';
            $this->circletHasOne['taskLog']['comment'] = 'The tagged task log.';
            $this->circletHasMany = [];
            $this->hasManyThrough = [];
            $this->allIds = Arr::except($this->allIds, ['parent_id', 'matrix_id']);
            $this->matrix = [];
            $this->flags = [];
            $this->permissions = [];
            $this->status = [];
            $this->ui = [];
            $this->unique = [];
            $this->timestamp_deleted = '';
            $this->timestamp_updated = '';
            $this->handleCircletHasOne();
            return;
        }
        $this->addColumns();
        $this->addDates();
        $this->addFlags();
        $this->addJson();
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
        $this->handleHasManyThrough();
        //dd($this);
        //dump([
        //    '__METHOD__' => __METHOD__,
        //    '$this->hasManyThrough' => $this->hasManyThrough,
        //]);
    }
}
