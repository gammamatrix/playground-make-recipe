<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Recipe;
use Playground\Make\Recipe\Http\Requests\Recipe\FormRecipeRequest;
use Playground\Make\Recipe\Http\Requests\Recipe\SaveRecipeRequest;
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
    public function delete(Manager $manager, string $slug): RedirectResponse
    {
        $manager->delete($slug);

        return response()->redirectToRoute('playground.make.recipe');
    }

    /**
     * Show the form.
     */
    public function form(FormRecipeRequest $request, Manager $manager, ?string $slug = null): View
    {
        $packageInfo = $this->packageInfo();

        $validated = $request->validated();

        $_return_url = empty($validated['_return_url']) ? route('playground.make.recipe') : $validated['_return_url'];

        $recipe = empty($slug) ? null : $manager->get($slug);

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
    public function save(SaveRecipeRequest $request, Manager $manager, ?string $slug = null): RedirectResponse
    {
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$request' => $request,
        //            '$slug' => $slug,
        //        ]);

        $recipe = empty($slug) ? null : $manager->get($slug);

        if (empty($recipe)) {
            $recipe = new Recipe($request->validated());
        } else {
            $recipe->setOptions($request->validated());
        }

        $recipe->apply();

        $manager->save($recipe);

        if (empty($slug)) {
            $slug = $recipe->slug();
        }
        //        dd([
        //            '__METHOD__' => __METHOD__,
        //            '$slug' => $slug,
        //            '$recipe' => $recipe,
        //        ]);

        return response()->redirectToRoute('playground.make.recipe.form', ['slug' => $slug]);
    }
}
