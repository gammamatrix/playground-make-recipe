<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Recipe;
use Playground\Make\Recipe\Http\Requests;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\IndexController
 */
class ModelController extends Controller
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
     * Delete a recipe
     */
    public function delete(Manager $manager, string $slug): RedirectResponse
    {
        $manager->delete($slug);

        return response()->redirectToRoute('playground.make.recipe');
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
            'recipe' => empty($slug) ? new Recipe : $manager->get($slug),
        ]);
    }

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
     * Save a model.
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

    public function addModel(
        Manager $manager,
        Requests\AddModelRequest $request
    ): RedirectResponse {

        $manager->addModel($request->validated());

        return response()->redirectToRoute('playground.make.recipe.form', [
            'slug' => $manager->slug(),
        ]);
    }

    public function deleteModel(
        Manager $manager,
        Requests\DeleteModelRequest $request
    ): RedirectResponse {

        $manager->addModel($request->validated());

        return response()->redirectToRoute('playground.make.recipe.form', [
            'slug' => $manager->slug(),
        ]);
    }
}
