<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Column;
use Playground\Make\Recipe\Http\Requests\Column\FormRequest;
use Playground\Make\Recipe\Http\Requests\Column\SaveRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\ColumnController
 */
class ColumnController extends Controller
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
    public function delete(
        Manager $manager,
        string $recipe_slug,
        string $column_slug
    ): RedirectResponse {
        $recipe = $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with(
                'error',
                __('playground-make-recipe::building.recipe.404', ['recipe' => $recipe_slug])
            );
        }
        $recipe->removeColumn($column_slug);

        $recipe->apply();

        $manager->save($recipe);

        return response()->redirectToRoute('playground.make.recipe.form', ['recipe_slug' => $recipe_slug]);
    }

    /**
     * Show the form.
     */
    public function form(
        string $recipe_slug,
        FormRequest $request,
        Manager $manager,
        ?string $column_slug = null
    ): View|RedirectResponse {

        $recipe = $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with(
                'error',
                __('playground-make-recipe::building.recipe.404', ['recipe' => $recipe_slug])
            );
        }

        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $_return_url = empty($validated['_return_url']) ? route('playground.make.recipe.form', ['recipe_slug' => $recipe_slug]) : $validated['_return_url'];

        if (empty($column_slug)) {
            $column_slug = $validated['column'] ?? '';
        }

        if (! empty($column_slug) && is_string($column_slug)) {
            $column = $recipe->column($column_slug);
        }

        if (empty($column)) {
            $column = new Column($validated);
        } else {
            $column->setOptions($validated);
        }

        $column->apply();

        $flash = $column->toArray();

        $flash['_return_url'] = $_return_url;

        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            'column_slug' => $column,
            'recipe_slug' => $recipe_slug,
            'recipe' => $recipe,
            'column' => $column,
            '_return_url' => $_return_url,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::column/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Save a recipe
     */
    public function save(
        string $recipe_slug,
        SaveRequest $request,
        Manager $manager,
        ?string $column_slug = null
    ): RedirectResponse {

        $recipe = $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with(
                'error',
                __('playground-make-recipe::building.recipe.404', ['recipe' => $recipe_slug])
            );
        }

        /**
         * @var array{
         *     column?: string,
         *     type?: string,
         *     description?: string,
         *     label?: string,
         *     index?: bool,
         *     nullable?: bool,
         *     _return_url?: string,
         * } $validated
         */
        $validated = $request->validated();

        if (empty($column_slug)) {
            $column_slug = $validated['column'] ?? '';
        }

        $column = $recipe->column($column_slug);

        if (empty($column)) {
            $column = new Column($validated);
        } else {
            $column->setOptions($validated);
        }

        $column->apply();

        $recipe->addColumn($column_slug, $column);

        $recipe->apply();

        $manager->save($recipe);

        if (! empty($validated['_return_url']) && is_string($validated['_return_url'])) {
            return response()->redirectTo($validated['_return_url']);
        }

        return response()->redirectToRoute(
            'playground.make.recipe.form', ['recipe_slug' => $recipe_slug]
        );
    }
}
