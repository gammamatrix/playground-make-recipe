<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\View\View;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\IndexController
 */
class FormController extends Controller
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
    public function index(Manager $manager): View
    {
        $packageInfo = $this->packageInfo();

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::index', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
            'recipes' => $manager->index(),
        ]);
    }

    /**
     * Show the form.
     */
    public function form(Manager $manager, ?string $slug = null): View
    {
        $packageInfo = $this->packageInfo();

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::form', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
            '_return_url' => '',
            'recipe' => empty($slug) ? null : $manager->get($slug),
        ]);
    }

    /**
     * Save a recipe
     */
    public function save(Manager $manager, ?string $slug = null): View
    {
        $packageInfo = $this->packageInfo();

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::form', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
            '_return_url' => '',
            'recipe' => empty($slug) ? null : $manager->get($slug),
        ]);
    }
}
