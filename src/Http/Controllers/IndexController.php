<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\View\View;

/**
 * \Playground\Make\Recipe\Http\Controllers\IndexController
 */
class IndexController extends Controller
{
    /**
     * @var array<string, string>
     */
    public array $packageInfo = [
        'module_label' => 'Make',
        'module_label_plural' => 'Makes',
        'module_route' => 'playground.make.recipe',
        'module_slug' => 'make',
        'privilege' => 'playground-make-recipe',
        'view' => 'playground-make-recipe',
    ];

    /**
     * Show the index.
     */
    public function index(): View
    {
        $packageInfo = $this->packageInfo();

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::index', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
        ]);
    }
}
