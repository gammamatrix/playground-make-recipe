<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\FactoryState;
use Playground\Make\Recipe\Http\Requests\FactoryState\FormRequest;
use Playground\Make\Recipe\Http\Requests\FactoryState\SaveRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\FactoryStateController
 */
class FactoryStateController extends Controller
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
        string $slug
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
        $recipe->removeFactoryState($slug);

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
        ?string $slug = null
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

        if (empty($slug)) {
            $slug = $validated['state'] ?? '';
        }

        if (! empty($slug) && is_string($slug)) {
            $factoryState = $recipe->factoryState($slug);
        }

        if (empty($factoryState)) {
            $factoryState = new FactoryState($validated);
        } else {
            $factoryState->setOptions($validated);
        }

        $factoryState->apply();

        $flash = $factoryState->toArray();

        if (array_key_exists('value', $flash)) {
            if (is_bool($flash['value'])) {
                $flash['value'] = empty($flash['value']) ? 'false' : 'true';
            } elseif (is_array($flash['value'])) {
                $flash['value'] = json_encode($flash['value']);
            } elseif (is_object($flash['value'])) {
                $flash['value'] = json_encode($flash['value']);
            }
        }

        $flash['_return_url'] = $_return_url;

        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            'factoryState_slug' => $slug,
            'recipe_slug' => $recipe_slug,
            'recipe' => $recipe,
            'factoryState' => $factoryState,
            '_return_url' => $_return_url,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::factory-state/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Save a recipe
     */
    public function save(
        string $recipe_slug,
        SaveRequest $request,
        Manager $manager,
        ?string $slug = null
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
         *     description?: string,
         *     label?: string,
         *     index?: bool,
         *     nullable?: bool,
         *     _return_url?: string,
         * } $validated
         */
        $validated = $request->validated();

        if (empty($slug)) {
            $slug = $validated['state'] ?? '';
        }

        $factoryState = $recipe->factoryState($slug);

        if (empty($factoryState)) {
            $factoryState = new FactoryState($validated);
        } else {
            $factoryState->setOptions($validated);
        }

        $factoryState->apply();

        $recipe->addFactoryState($slug, $factoryState);

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
