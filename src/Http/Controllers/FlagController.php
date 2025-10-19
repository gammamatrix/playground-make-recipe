<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Flag;
use Playground\Make\Recipe\Configuration\Recipe;
use Playground\Make\Recipe\Http\Requests\Flag\FormRequest;
use Playground\Make\Recipe\Http\Requests\Flag\SaveRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\IndexController
 */
class FlagController extends Controller
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
        //         dd([
        //            '__METHOD__' => __METHOD__,
        //             '$recipe' => $recipe,
        //             '$recipe_slug' => $recipe_slug,
        //             '$column' => $column,
        //         ]);
        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with(
                'error',
                __('playground-make-recipe::building.recipe.404', ['recipe' => $recipe_slug])
            );
        }
        $recipe->removeFlag($column);

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
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$recipe' => $recipe,
        // ]);
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
            $flag = $recipe->flag($column);
        }

        if (empty($flag)) {
            $flag = new Flag($validated);
        } else {
            $flag->setOptions($validated);
        }

        $flag->apply();

        $flash = $flag->toArray();

        $flash['_return_url'] = $_return_url;
        //         dd([
        //            '__METHOD__' => __METHOD__,
        //            '$flash' => $flash,
        //            '$recipe' => $recipe,
        //         ]);
        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            'flag_slug' => $column,
            'recipe_slug' => $recipe_slug,
            'recipe' => $recipe,
            'flag' => $flag,
            '_return_url' => $_return_url,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::flag/form', $packageInfo->view());

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
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$recipe' => $recipe,
        //        ]);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with(
                'error',
                __('playground-make-recipe::building.recipe.404', ['recipe' => $recipe_slug])
            );
        }

        /**
         * @var array{
         *     column?: string,
         *     description?: string,
         *     label?: string,
         *     index?: bool,
         *     nullable?: bool,
         *     _return_url?: string,
         * } $validated
         */
        $validated = $request->validated();

        if (empty($column)) {
            $column = $validated['column'] ?? '';
        }

        $flag = $recipe->flag($column);

        if (empty($flag)) {
            $flag = new Flag($validated);
        } else {
            $flag->setOptions($validated);
        }

        //         dump([
        //            '__METHOD__' => __METHOD__,
        //             '$column' => $column,
        //             '$validated' => $validated,
        //            '$flag' => $flag,
        //         ]);
        $flag->apply();
        //         dd([
        //            '__METHOD__' => __METHOD__,
        //            '$validated' => $validated,
        //            '$flag' => $flag,
        //         ]);

        $recipe->addFlag($column, $flag);

        $recipe->apply();

        $manager->save($recipe);

        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$recipe' => $recipe,
        //            '$flag' => $flag,
        //            '$validated' => $validated,
        //        ]);

        if (! empty($validated['_return_url']) && is_string($validated['_return_url'])) {
            return response()->redirectTo($validated['_return_url']);
        }

        return response()->redirectToRoute(
            'playground.make.recipe.form', ['recipe_slug' => $recipe_slug]
        );
    }
}
