<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Id;
use Playground\Make\Recipe\Http\Requests\Id\FormRequest;
use Playground\Make\Recipe\Http\Requests\Id\SaveRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\IdController
 */
class IdController extends Controller
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
        string $column
    ): RedirectResponse {
        $recipe = $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with(
                'error',
                __('playground-make-recipe::building.recipe.404', ['recipe' => $recipe_slug])
            );
        }
        $recipe->removeId($column);

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
        ?string $column = null
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

        if (empty($column)) {
            $column = $validated['column'] ?? '';
        }

        if (! empty($column) && is_string($column)) {
            $id = $recipe->id($column);
        }

        if (empty($id)) {
            $id = new Id($validated);
        } else {
            $id->setOptions($validated);
        }

        $id->apply();

        $flash = $id->toArray();
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$flash' => $flash,
        // ]);
        $flash['_return_url'] = $_return_url;

        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            'column' => $id,
            'recipe_slug' => $recipe_slug,
            'recipe' => $recipe,
            'id' => $id,
            '_return_url' => $_return_url,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::id/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Save a recipe
     */
    public function save(
        string $recipe_slug,
        SaveRequest $request,
        Manager $manager,
        ?string $column = null
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
         *     id?: string,
         *     type?: string,
         *     description?: string,
         *     label?: string,
         *     index?: bool,
         *     nullable?: bool,
         *     _return_url?: string,
         * } $validated
         */
        $validated = $request->validated();
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$request->input()' => $request->input(),
        //    '$validated' => $validated,
        // ]);
        if (empty($column)) {
            $column = $validated['column'] ?? '';
        }

        $id = $recipe->id($column);

        if (empty($id)) {
            $id = new Id($validated);
        } else {
            $id->setOptions($validated);
        }

        $id->apply();

        $recipe->addId($column, $id);

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
