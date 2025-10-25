<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Http\Requests\Flavor\FormRequest;
use Playground\Make\Recipe\Http\Requests\Flavor\SaveRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\FlavorController
 */
class FlavorController extends Controller
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
     * Delete a flavor
     */
    public function delete(
        Manager $manager,
        string $recipe_slug,
        string $flavor
    ): RedirectResponse {
        $recipe = $manager->get($recipe_slug);

        if (empty($recipe)) {
            return response()->redirectToRoute('playground.make.recipe')->with(
                'error',
                __('playground-make-recipe::building.recipe.404', ['recipe' => $recipe_slug])
            );
        }

        $recipe->removeFlavor($flavor);

        $recipe->apply();

        $manager->save($recipe);

        return response()->redirectToRoute('playground.make.recipe.form', ['recipe_slug' => $recipe_slug]);
    }

    /**
     * Show the flavor form.
     */
    public function form(
        string $recipe_slug,
        FormRequest $request,
        Manager $manager,
        ?string $flavor = null
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

        if (empty($flavor)) {
            $flavor = $validated['flavor'] ?? '';
        }

        $flash = [
            'flavor' => $flavor,
        ];

        $flash['_return_url'] = $_return_url;

        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            'flavor_slug' => $flavor,
            'recipe_slug' => $recipe_slug,
            'recipe' => $recipe,
            'flavor' => $flavor,
            '_return_url' => $_return_url,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::flavor/form', $packageInfo->view());

        return view($view, $data);
    }

    /**
     * Save a recipe
     */
    public function save(
        string $recipe_slug,
        SaveRequest $request,
        Manager $manager,
        ?string $flavor = null
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
         *     flavor?: string,
         *     _return_url?: string,
         * } $validated
         */
        $validated = $request->validated();

        if (empty($flavor)) {
            $flavor = $validated['flavor'] ?? '';
        }

        $recipe->addFlavor($flavor);

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
