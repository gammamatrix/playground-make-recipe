<?php

/**
 * Playground
 */

declare(strict_types=1);

namespace Playground\Make\Recipe\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Playground\Make\Recipe\Configuration\Json;
use Playground\Make\Recipe\Http\Requests\Json\FormRequest;
use Playground\Make\Recipe\Http\Requests\Json\SaveRequest;
use Playground\Make\Recipe\Manager;

/**
 * \Playground\Make\Recipe\Http\Controllers\JsonController
 */
class JsonController extends Controller
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
        $recipe->removeJson($column);

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
            $json = $recipe->jsonColumn($column);
        }

        if (empty($json)) {
            $json = new Json($validated);
        } else {
            $json->setOptions($validated);
        }
        // dump([
        //    '__METHOD__' => __METHOD__,
        //    '$column' => $column,
        //    '$recipe' => $recipe,
        //    '$json' => $json,
        //    '$validated' => $validated,
        // ]);

        $json->apply();

        $flash = $json->toArray();

        // $flash['default'] = !is_string($flash['default']) ? json_encode($flash['default'], JSON_PRETTY_PRINT) : $flash['default'];
        $flash['_return_url'] = $_return_url;

        session()->flashInput($flash);

        $data = [
            'packageInfo' => $packageInfo,
            'json_slug' => $column,
            'recipe_slug' => $recipe_slug,
            'recipe' => $recipe,
            'json' => $json,
            '_return_url' => $_return_url,
        ];

        /**
         * @var view-string $view
         */
        $view = sprintf('%1$s::json/form', $packageInfo->view());

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
         *     column?: string,
         *     comment?: string,
         *     default?: string,
         *     description?: string,
         *     type?: 'JSON_ARRAY'|'JSON_OBJECT',
         *     label?: string,
         *     index?: bool,
         *     nullable?: bool,
         *     readOnly?: bool,
         *     _return_url?: string,
         * } $validated
         */
        $validated = $request->validated();

        if (empty($column)) {
            $column = $validated['column'] ?? '';
        }

        $json = $recipe->jsonColumn($column);
        // dump([
        //    '__METHOD__' => __METHOD__,
        //    '$json' => $json,
        //    '$column' => $column,
        //    '$validated' => $validated,
        // ]);
        if (empty($json)) {
            $json = new Json($validated);
        } else {
            $json->setOptions($validated);
        }

        $json->apply();

        // dd([
        //    '__METHOD__' => __METHOD__,
        //    '$json' => $json,
        // ]);
        $recipe->addJsonColumn($column, $json);

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
