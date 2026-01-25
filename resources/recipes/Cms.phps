<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Model\Recipe;

/**
 * \Playground\Make\Model\Recipe\Cms
 */
class Cms extends Playground
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
        'resumed_at' => [
            'nullable' => true,
            'index' => false,
        ],
        'resolved_at' => [
            'nullable' => true,
            'index' => true,
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

    protected array $hasMany = [
        'revisions' => [
            'comment' => 'The revisions of the model.',
            'accessor' => 'revisions',
            'related' => '',
            'foreignKey' => '',
            'localKey' => 'id',
        ],
    ];

    protected array $hasOne = [
        'page' => [
            'comment' => 'The page of the revision.',
            'accessor' => 'page',
            'related' => 'Page',
            'foreignKey' => 'id',
            'localKey' => 'page_id',
        ],
        'snippet' => [
            'comment' => 'The snippet of the revision.',
            'accessor' => 'snippet',
            'related' => 'Snippet',
            'foreignKey' => 'id',
            'localKey' => 'snippet_id',
        ],
    ];

    protected array $ids = [
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
        'page_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'cms_pages',
            ],
            'index' => true,
            'nullable' => true,
            'type' => 'uuid',
        ],
        'snippet_id' => [
            'description' => '',
            'foreign' => [
                'references' => 'id',
                'on' => 'cms_snippets',
            ],
            'index' => true,
            'nullable' => true,
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

    public function init(): void
    {
        $this->withRevisions();
        $this->withRouting();
    }

    public function withRevisions(): void
    {
        $this->status['revision'] = [
            'type' => 'bigInteger',
            'default' => false,
            'unsigned' => true,
            'readOnly' => true,
            'icon' => '',
        ];

        if (! in_array($this->name(), [
            'Page',
            'Snippet',
        ])) {
            unset($this->hasMany['revisions']);
        }

        if (in_array($this->name(), [
            'Page',
        ])) {
            $this->hasMany['revisions']['comment'] = 'The revisions of the page.';
            $this->hasMany['revisions']['related'] = 'PageRevision';
            $this->hasMany['revisions']['foreignKey'] = 'page_id';
        }

        if (! in_array($this->name(), [
            'PageRevision',
        ])) {
            unset($this->ids['page_id']);
            unset($this->hasOne['page']);
        }

        if (in_array($this->name(), [
            'Snippet',
        ])) {
            $this->hasMany['revisions']['comment'] = 'The revisions of the snippet.';
            $this->hasMany['revisions']['related'] = 'SnippetRevision';
            $this->hasMany['revisions']['foreignKey'] = 'snippet_id';
        }

        if (! in_array($this->name(), [
            'SnippetRevision',
        ])) {
            unset($this->ids['snippet_id']);
            unset($this->hasOne['snippet']);
        }
    }

    public function withRouting(): void
    {
        if (in_array($this->name(), [
            'Page',
            'PageRevision',
        ])) {
            $this->flags['is_external'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-close',
            ];
            $this->flags['is_redirect'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-close',
            ];
            $this->flags['sitemap'] = [
                'type' => 'boolean',
                'default' => false,
                'icon' => 'fa-solid fa-sitemap text-success',
            ];
            /**
             * Routing
             *
             * redirect_delay   in seconds
             * status_code      200 - 500
             * route            home, playground.cms.api.pages.create, ...
             * params
             */
            $this->status['redirect_delay'] = [
                'type' => 'integer',
                'default' => false,
                'unsigned' => true,
                'icon' => '',
            ];
            $this->status['status_code'] = [
                'type' => 'integer',
                'default' => false,
                'unsigned' => true,
                'icon' => '',
            ];
            $this->status['route'] = [
                'type' => 'string',
                'nullable' => true,
                'size' => 255,
                'icon' => '',
            ];
            $this->json['params'] = [
                'default' => '{}',
                'nullable' => true,
                'type' => 'JSON_OBJECT',
            ];
        }
    }
}
