<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Recipe;
use Playground\Make\Recipe\Http\Requests\Recipe\FormRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\SaveRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\IndexController
 */
class RecipeController extends Controller
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
        string $recipe_slug
    ): RedirectResponse {
        $manager->delete($recipe_slug);

        return response()->redirectToRoute('playground.make.recipe');
    }

    /**
     * Show the form.
     */
    public function form(
        FormRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): View {
        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $_return_url = empty($validated['_return_url']) ? route('playground.make.recipe') : $validated['_return_url'];

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        if (empty($recipe)) {
            $recipe = new Recipe;
        }

        $flash = $recipe->toArray();

        $flash['_return_url'] = $_return_url;
        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$flash' => $flash,
        //    '$recipe' => $recipe,
        // ]);
        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            '_return_url' => $_return_url,
            'recipe' => $recipe,
            'recipe_slug' => $recipe_slug,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::recipe/form', $packageInfo->view());

        return view($view, $data);
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
        $view = sprintf('%1$s::recipe/index', $packageInfo->view());

        return view($view, [
            'packageInfo' => $packageInfo,
            'recipes' => $manager->index(),
        ]);
    }

    /**
     * Save a recipe
     */
    public function save(
        SaveRequest $request,
        Manager $manager,
        ?string $recipe_slug = null
    ): RedirectResponse {
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$request' => $request,
        //            '$recipe_slug' => $recipe_slug,
        //        ]);

        $recipe = empty($recipe_slug) ? null : $manager->get($recipe_slug);

        if (empty($recipe)) {
            $recipe = new Recipe($request->validated());
        } else {
            $recipe->setOptions($request->validated());
        }

        $recipe->apply();

        $manager->save($recipe);

        if (empty($recipe_slug)) {
            $recipe_slug = $recipe->slug();
        }
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$recipe_slug' => $recipe_slug,
        //            '$recipe' => $recipe,
        //        ]);

        return response()->redirectToRoute('playground.make.recipe.form', [
            'recipe_slug' => $recipe_slug,
        ]);
    }
}
