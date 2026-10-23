<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace App\Recipes;

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
        'tagged_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'task_tagged',
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
        'active' => [
            'type' => 'flag',
            'value' => true,
        ],
        'locked' => [
            'type' => 'flag',
            'value' => true,
        ],
        'skipped' => [
            'type' => 'flag',
            'value' => true,
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
        'tags' => [
            'comment' => 'The tags of the %1$s.',
            'accessor' => 'tags',
            'related' => 'Tag',
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
            'label' => 'Week of Quarter',
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

        $this->dates['skipped_at'] = [
            'label' => 'Skipped at',
            'nullable' => true,
        ];

        ksort($this->dates);
    }

    public function addFlags(): void
    {
        $this->flags['skipped'] = [
            'icon' => 'fa-solid fa-forward-step text-warning',
            'default' => false,
            'label' => 'Skipped',
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
        /**
         * @var array<string, array<string, mixed>> $allIds
         */
        $allIds = \Illuminate\Support\Arr::except($this->allIds, ['parent_id', 'matrix_id']);

        if ($this->type === 'playground-model-tagged') { 
            $this->circletHasOne['task']['comment'] = 'The tagged task.';
            $this->circletHasOne['taskList']['comment'] = 'The tagged task list.';
            $this->circletHasOne['taskLog']['comment'] = 'The tagged task log.';
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
        $this->addJson();
        $this->handleCircletHasOne();
        $this->handleCircletHasMany();
    }
}
